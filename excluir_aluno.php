<?php
//SO EXCLUI PELO BOTAO DA LISTA (POST); ABRIR O LINK DIRETO VOLTA PARA A LISTA
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: pesquisageral.php');
  exit;
}

include_once('conexao.php');

$matricula = $_POST['matricula'];

//EXCLUSAO (PREPARED STATEMENT)
$stmt = mysqli_prepare($conexao, "DELETE FROM aluno WHERE matricula = ?");
mysqli_stmt_bind_param($stmt, "s", $matricula);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
  $msg_tipo  = "msg-success";
  $msg_texto = "Aluno de matrícula <strong>" . htmlspecialchars($matricula) . "</strong> excluído com sucesso.";
} else {
  $msg_tipo  = "msg-error";
  $msg_texto = "Aluno não encontrado. Ele pode já ter sido excluído.";
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Aluno — Sistema Escolar</title>
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
      <h1>Excluir Aluno</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="pesquisageral.php" class="btn btn-primary">Voltar à Lista</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>
