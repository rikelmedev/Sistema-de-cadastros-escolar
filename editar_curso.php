<?php
include_once('conexao.php');

//SE O FORMULARIO FOI ENVIADO (POST), SALVA AS ALTERACOES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $codigo    = $_POST['codcurso'];
  $nomecurso = $_POST['nomecurso'];
  $cod1      = $_POST['coddisciplina1'];
  $cod2      = $_POST['coddisciplina2'];
  $cod3      = $_POST['coddisciplina3'];

  //O CODIGO DO CURSO NAO MUDA: ELE SO IDENTIFICA QUAL CURSO ATUALIZAR
  $stmt = mysqli_prepare($conexao,
    "UPDATE curso SET nome = ?, coddisciplina01 = ?, coddisciplina02 = ?, coddisciplina03 = ? WHERE codcurso = ?"
  );
  mysqli_stmt_bind_param($stmt, "sssss", $nomecurso, $cod1, $cod2, $cod3, $codigo);

  if (mysqli_stmt_execute($stmt)) {
    $msg_tipo  = "msg-success";
    $msg_texto = "Curso <strong>" . htmlspecialchars($nomecurso) . "</strong> atualizado com sucesso!";
  } elseif (mysqli_stmt_errno($stmt) == 1452) {
    //1452 = ALGUM CODIGO DE DISCIPLINA NAO EXISTE NA TABELA DISCIPLINA
    $msg_tipo  = "msg-error";
    $msg_texto = "Uma ou mais disciplinas informadas não existem. Confira os códigos na lista de disciplinas.";
  } else {
    $msg_tipo  = "msg-error";
    $msg_texto = "Erro ao atualizar. Tente novamente.";
  }
  mysqli_stmt_close($stmt);

//SE A PAGINA FOI ABERTA PELA LISTA (GET), BUSCA O CURSO PARA PREENCHER O FORMULARIO
} else {
  $codigo = isset($_GET['codcurso']) ? $_GET['codcurso'] : '';

  $stmt = mysqli_prepare($conexao, "SELECT * FROM curso WHERE codcurso = ?");
  mysqli_stmt_bind_param($stmt, "s", $codigo);
  mysqli_stmt_execute($stmt);
  $curso = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
  mysqli_stmt_close($stmt);

  if (!$curso) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Curso não encontrado.";
  } else {
    //BUSCA AS DISCIPLINAS UMA VEZ SO E GUARDA NUM ARRAY (USADO NAS 3 LISTAS)
    $resultado   = mysqli_query($conexao, "SELECT coddisciplina, nome_disciplina FROM disciplina ORDER BY nome_disciplina");
    $disciplinas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }
}

//MONTA AS OPCOES DE UMA LISTA DE DISCIPLINAS, MARCANDO A QUE JA ESTA ESCOLHIDA
function opcoes_disciplinas($disciplinas, $selecionada) {
  foreach ($disciplinas as $d) {
    $marcada = ($d['coddisciplina'] == $selecionada) ? ' selected' : '';
    echo '<option value="' . htmlspecialchars($d['coddisciplina']) . '"' . $marcada . '>'
       . htmlspecialchars($d['coddisciplina'] . ' — ' . $d['nome_disciplina'])
       . '</option>';
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Curso — Sistema Escolar</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">

  <div class="sys-header">
    <div class="sys-logo">SE</div>
    <div>
      <div class="sys-title">Sistema Escolar</div>
      <div class="sys-subtitle">Gestão de alunos, cursos e disciplinas</div>
    </div>
  </div>

  <div class="card">

    <?php if (isset($msg_texto)): ?>
      <!-- Resultado da edicao (ou curso nao encontrado) -->
      <div class="page-header">
        <h1>Editar Curso</h1>
      </div>
      <div class="msg <?php echo $msg_tipo; ?>">
        <?php echo $msg_texto; ?>
      </div>
      <div class="divider"></div>
      <div class="btn-group">
        <a href="geralcurso.php" class="btn btn-primary">Voltar à Lista</a>
        <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
      </div>

    <?php else: ?>
      <!-- Formulario preenchido com os dados atuais do curso -->
      <div class="card-title">Editar Curso</div>

      <form action="editar_curso.php" method="POST">

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Código do Curso (não pode ser alterado)</label>
            <input class="form-input" type="text" name="codcurso"
                   value="<?php echo htmlspecialchars($curso['codcurso']); ?>" readonly>
          </div>
          <div class="form-group">
            <label class="form-label">Nome do Curso</label>
            <input class="form-input" type="text" name="nomecurso"
                   value="<?php echo htmlspecialchars($curso['nome']); ?>" required>
          </div>
        </div>

        <div class="divider"></div>
        <div class="card-title">Disciplinas vinculadas</div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Disciplina 1</label>
            <select class="form-input" name="coddisciplina1" required>
              <?php opcoes_disciplinas($disciplinas, $curso['coddisciplina01']); ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Disciplina 2</label>
            <select class="form-input" name="coddisciplina2" required>
              <?php opcoes_disciplinas($disciplinas, $curso['coddisciplina02']); ?>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Disciplina 3</label>
            <select class="form-input" name="coddisciplina3" required>
              <?php opcoes_disciplinas($disciplinas, $curso['coddisciplina03']); ?>
            </select>
          </div>
        </div>

        <div class="divider"></div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          <a href="geralcurso.php" class="btn btn-ghost">Cancelar</a>
        </div>

      </form>
    <?php endif; ?>

  </div>

</div>
</body>
</html>
<?php mysqli_close($conexao); ?>
