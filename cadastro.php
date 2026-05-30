<html>
<head>
<title></title>
</head>
<body>
<?php
include_once ('conexao.php');
//recupernado
$matricula = $_POST['matricula'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$curso = $_POST['codcurso'];
//criando linha de insert
$sqlinsert = "insert into aluno(matricula, nome, endereco, cidade, codcurso)
VALUES ('$matricula', '$nome', '$endereco', '$cidade', '$curso')";
//executando instrucao sql
$resultado = @mysqli_query($conexao, $sqlinsert);
if (!$resultado)
{
die('Query Inválida: '. @mysqli_error($conexao));
}else
{ 
echo "registro realizado com sucesso!";
}
mysqli_close($conexao);
?>
<br>
<br>
<input type='button' onclick="window.location='index.php';" VALUE ="Voltar">
</body>
</html>
