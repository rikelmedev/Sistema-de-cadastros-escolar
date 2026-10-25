<?php
//SO EXCLUI PELO BOTAO DA LISTA (POST); ABRIR O LINK DIRETO VOLTA PARA A LISTA
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: geraldisciplina.php');
  exit;
}

include_once('conexao.php');

$codigo = $_POST['coddisciplina'];

//EXCLUSAO (PREPARED STATEMENT)
$stmt = mysqli_prepare($conexao, "DELETE FROM disciplina WHERE coddisciplina = ?");
mysqli_stmt_bind_param($stmt, "s", $codigo);
$resultado = mysqli_stmt_execute($stmt);

if (!$resultado && mysqli_stmt_errno($stmt) == 1451) {
  //1451 = A DISCIPLINA AINDA E USADA POR ALGUM CURSO (CHAVE ESTRANGEIRA)
  $msg_tipo  = "msg-error";
  $msg_texto = "A disciplina <strong>" . htmlspecialchars($codigo) . "</strong> faz parte de algum curso e não pode ser excluída. Troque essa disciplina nos cursos antes.";
} elseif (!$resultado) {
  $msg_tipo  = "msg-error";
  $msg_texto = "Erro ao excluir. Tente novamente.";
} elseif (mysqli_stmt_affected_rows($stmt) > 0) {
  $msg_tipo  = "msg-success";
  $msg_texto = "Disciplina <strong>" . htmlspecialchars($codigo) . "</strong> excluída com sucesso.";
} else {
  $msg_tipo  = "msg-error";
  $msg_texto = "Disciplina não encontrada. Ela pode já ter sido excluída.";
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Disciplina — Sistema Escolar</title>
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
      <h1>Excluir Disciplina</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="geraldisciplina.php" class="btn btn-primary">Voltar à Lista</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>
