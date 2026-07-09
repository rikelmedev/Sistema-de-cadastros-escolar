<?php
include_once('conexao.php');

//RECUPERAÇÃO DOS DADOS DO FORMULÁRIO
$matricula = $_POST['matricula'];
$nome      = $_POST['nome'];
$endereco  = $_POST['endereco'];
$cidade    = $_POST['cidade'];
$curso     = $_POST['codcurso'];

//CRIANDO LINHA DO INSERT (PREPARED STATEMENT)
$stmt = mysqli_prepare($conexao,
  "INSERT INTO aluno (matricula, nome, endereco, cidade, codcurso) VALUES (?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "sssss", $matricula, $nome, $endereco, $cidade, $curso);

//EXECUÇÃO E VERIFICAÇÃO DO RESULTADO
$resultado = mysqli_stmt_execute($stmt);

if (!$resultado) {
  if (mysqli_stmt_errno($stmt) == 1062) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Matrícula <strong>" . htmlspecialchars($matricula) . "</strong> já cadastrada. Use outra.";
  } else {
    $msg_tipo  = "msg-error";
    $msg_texto = "Erro ao cadastrar. Tente novamente.";
  }
} else {
  $msg_tipo  = "msg-success";
  $msg_texto = "Aluno <strong>" . htmlspecialchars($nome) . "</strong> cadastrado com sucesso!";
}

mysqli_stmt_close($stmt);

mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Alunos — Sistema Escolar</title>
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
      <h1>Cadastro de Alunos</h1>
    </div>
    <div class="msg <?php echo $msg_tipo; ?>">
      <?php echo $msg_texto; ?>
    </div>
    <div class="divider"></div>
    <div class="btn-group">
      <a href="cadalunos.html" class="btn btn-primary">Cadastrar Outro</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>