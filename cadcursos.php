<?php
//SE A PAGINA FOR ABERTA SEM ENVIAR O FORMULARIO, VOLTA PARA O FORMULARIO
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: form_curso.php');
  exit;
}

include_once('conexao.php');

//RECUPERAÇÃO DOS DADOS DO FORMULÁRIO
$codigo      = $_POST['codcurso'];
$nomecurso   = $_POST['nomecurso'];
//disciplinas[] CHEGA COMO LISTA COM OS CODIGOS DAS CAIXAS MARCADAS
$disciplinas = isset($_POST['disciplinas']) ? array_unique((array) $_POST['disciplinas']) : array();

if (count($disciplinas) == 0) {
  $msg_tipo  = "msg-error";
  $msg_texto = "Marque pelo menos uma disciplina para o curso.";
} else {
  //TRANSACAO: O CURSO E AS DISCIPLINAS SAO GRAVADOS JUNTOS.
  //SE QUALQUER INSERT FALHAR, O ROLLBACK DESFAZ TUDO E NADA FICA PELA METADE.
  mysqli_begin_transaction($conexao);

  $stmt = mysqli_prepare($conexao, "INSERT INTO curso (codcurso, nome) VALUES (?, ?)");
  mysqli_stmt_bind_param($stmt, "ss", $codigo, $nomecurso);
  $ok   = mysqli_stmt_execute($stmt);
  $erro = mysqli_stmt_errno($stmt);
  mysqli_stmt_close($stmt);

  //UMA LINHA EM curso_disciplina PARA CADA DISCIPLINA MARCADA
  if ($ok) {
    $stmt = mysqli_prepare($conexao, "INSERT INTO curso_disciplina (codcurso, coddisciplina) VALUES (?, ?)");
    foreach ($disciplinas as $coddisciplina) {
      mysqli_stmt_bind_param($stmt, "ss", $codigo, $coddisciplina);
      if (!mysqli_stmt_execute($stmt)) {
        $ok   = false;
        $erro = mysqli_stmt_errno($stmt);
        break;
      }
    }
    mysqli_stmt_close($stmt);
  }

  if ($ok) {
    mysqli_commit($conexao);
    $msg_tipo  = "msg-success";
    $msg_texto = "Curso <strong>" . htmlspecialchars($nomecurso) . "</strong> cadastrado com sucesso!";
  } else {
    mysqli_rollback($conexao);
    $msg_tipo = "msg-error";
    if ($erro == 1062) {
      $msg_texto = "Código <strong>" . htmlspecialchars($codigo) . "</strong> já cadastrado. Use outro.";
    } elseif ($erro == 1452) {
      //1452 = ALGUM CODIGO DE DISCIPLINA NAO EXISTE NA TABELA DISCIPLINA
      $msg_texto = "Uma ou mais disciplinas informadas não existem. Confira a lista de disciplinas.";
    } else {
      $msg_texto = "Erro ao cadastrar. Tente novamente.";
    }
  }
}

mysqli_close($conexao);
?>
<?php $titulo = "Cadastro de Cursos"; include 'cabecalho.php'; ?>

  <div class="card">
    <div class="page-header">
      <h1>Cadastro de Cursos</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="form_curso.php" class="btn btn-primary">Cadastrar Outro</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

<?php include 'rodape.php'; ?>
