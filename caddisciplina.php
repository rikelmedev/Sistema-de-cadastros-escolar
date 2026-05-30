<html>
<head>
<title></title>
</head>
<body>
<?php
include_once ('conexao.php');
//recupernado
$codigo = $_POST['coddisciplina'];
$nome = $_POST['nomedisciplina'];
//criando linha de insert
$sqlinsert = "insert into disciplina(coddisciplina, nome_disciplina) VALUES ('$codigo','$nome')";
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
