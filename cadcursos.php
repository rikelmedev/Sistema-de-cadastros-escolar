<html>
<head>
<title></title>
</head>
<body>
<?php
include_once ('conexao.php');
//recupernado
$codigo = $_POST['codcurso'];
$nome = $_POST['nomecurso'];
$cod1 = $_POST['coddisciplina1'];
$cod2 = $_POST['coddisciplina2'];
$cod3 = $_POST['coddisciplina3'];
//criando linha de insert
$sqlinsert = "insert into curso(codcurso, nome, coddisciplina01, coddisciplina02, coddisciplina03)
VALUES ('$codigo', '$nome', '$cod1', '$cod2', '$cod3')";
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
