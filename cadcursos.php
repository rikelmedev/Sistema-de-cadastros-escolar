<?php
include_once('conexao.php');

//RECUPERAÇÃO DOS DADOS DO FORMULÁRIO
$codigo    = $_POST['codcurso'];
$nomecurso = $_POST['nomecurso'];
$cod1      = $_POST['coddisciplina1'];
$cod2      = $_POST['coddisciplina2'];
$cod3      = $_POST['coddisciplina3'];

//CRIANDO LINHA DO INSERT
$sqlinsert = "INSERT INTO curso (codcurso, nome, coddisciplina01, coddisciplina02, coddisciplina03)
              VALUES ('$codigo', '$nomecurso', '$cod1', '$cod2', '$cod3')";

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
  $msg_texto = "Curso <strong>$nomecurso</strong> cadastrado com sucesso!";
}

mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Cursos — Sistema Escolar</title>
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
      <h1>Cadastro de Cursos</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="cadcurso.html" class="btn btn-primary">Cadastrar Outro</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>