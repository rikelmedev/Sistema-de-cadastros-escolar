<?php
include_once('conexao.php');

//RECUPERAÇÃO DOS DADOS DO FORMULÁRIO
$codigo         = $_POST['coddisciplina'];
$nomedisciplina = $_POST['nomedisciplina'];

//CRIANDO LINHA DO INSERT
$sqlinsert = "INSERT INTO disciplina (coddisciplina, nome_disciplina)
              VALUES ('$codigo', '$nomedisciplina')";

//EXECUÇÃO E VERIFICAÇÃO DO RESULTADO
$resultado = mysqli_query($conexao, $sqlinsert);

if (!$resultado) {
  if (mysqli_errno($conexao) == 1062) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Código <strong>$codigo</strong> já cadastrado. Use outro.";
  } else {
    $msg_tipo  = "msg-error";
    $msg_texto = "Erro ao cadastrar. Tente novamente.";
  }
} else {
  $msg_tipo  = "msg-success";
  $msg_texto = "Disciplina <strong>$nomedisciplina</strong> cadastrada com sucesso!";
}

mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Disciplinas — Sistema Escolar</title>
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
      <h1>Cadastro de Disciplinas</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="caddisciplina.html" class="btn btn-primary">Cadastrar Outra</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>