<?php
//SO EXCLUI PELO BOTAO DA LISTA (POST); ABRIR O LINK DIRETO VOLTA PARA A LISTA
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: geralcurso.php');
  exit;
}

include_once('conexao.php');

$codigo = $_POST['codcurso'];

//EXCLUSAO (PREPARED STATEMENT)
$stmt = mysqli_prepare($conexao, "DELETE FROM curso WHERE codcurso = ?");
mysqli_stmt_bind_param($stmt, "s", $codigo);
$resultado = mysqli_stmt_execute($stmt);

if (!$resultado && mysqli_stmt_errno($stmt) == 1451) {
  //1451 = O CURSO AINDA TEM ALUNOS VINCULADOS (CHAVE ESTRANGEIRA)
  $msg_tipo  = "msg-error";
  $msg_texto = "O curso <strong>" . htmlspecialchars($codigo) . "</strong> tem alunos matriculados e não pode ser excluído. Mude o curso desses alunos ou exclua-os antes.";
} elseif (!$resultado) {
  $msg_tipo  = "msg-error";
  $msg_texto = "Erro ao excluir. Tente novamente.";
} elseif (mysqli_stmt_affected_rows($stmt) > 0) {
  $msg_tipo  = "msg-success";
  $msg_texto = "Curso <strong>" . htmlspecialchars($codigo) . "</strong> excluído com sucesso.";
} else {
  $msg_tipo  = "msg-error";
  $msg_texto = "Curso não encontrado. Ele pode já ter sido excluído.";
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Curso — Sistema Escolar</title>
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
    <div class="page-header">
      <h1>Excluir Curso</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="geralcurso.php" class="btn btn-primary">Voltar à Lista</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>
