<?php
//SE A PAGINA FOR ABERTA SEM ENVIAR O FORMULARIO, VOLTA PARA O FORMULARIO
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: form_disciplina.php');
  exit;
}

include_once('conexao.php');

//RECUPERAÇÃO DOS DADOS DO FORMULÁRIO
$codigo         = $_POST['coddisciplina'];
$nomedisciplina = $_POST['nomedisciplina'];

//CRIANDO LINHA DO INSERT (PREPARED STATEMENT)
$stmt = mysqli_prepare($conexao,
  "INSERT INTO disciplina (coddisciplina, nome_disciplina) VALUES (?, ?)"
);
mysqli_stmt_bind_param($stmt, "ss", $codigo, $nomedisciplina);

//EXECUÇÃO E VERIFICAÇÃO DO RESULTADO
$resultado = mysqli_stmt_execute($stmt);

if (!$resultado) {
  if (mysqli_stmt_errno($stmt) == 1062) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Código <strong>" . htmlspecialchars($codigo) . "</strong> já cadastrado. Use outro.";
  } else {
    $msg_tipo  = "msg-error";
    $msg_texto = "Erro ao cadastrar. Tente novamente.";
  }
} else {
  $msg_tipo  = "msg-success";
  $msg_texto = "Disciplina <strong>" . htmlspecialchars($nomedisciplina) . "</strong> cadastrada com sucesso!";
}

mysqli_stmt_close($stmt);

mysqli_close($conexao);
?>
<?php $titulo = "Cadastro de Disciplinas"; include 'cabecalho.php'; ?>

  <div class="card">
    <div class="page-header">
      <h1>Cadastro de Disciplinas</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="form_disciplina.php" class="btn btn-primary">Cadastrar Outra</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

<?php include 'rodape.php'; ?>
