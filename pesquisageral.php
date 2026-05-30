<html>
<title> Semana 01 - Exemplo 04 </title>
<body>
<center>
<h3>Exemplo 04 - Listagem Geral de Nomes - Alunos</h3>
</center>
<?php
	include_once('conexao.php');
// ajustando a instrução select para ordenar por produto
$query = mysqli_query($conexao,"select * from aluno
 order by nome");
	if (!$query)
	{
		die('Query Inválida: ' . @mysqli_error($conexao));  
	}
		echo"<center>";
	echo "<table border='1px'>";
	echo "<tr><th width='30px' align='center'>Id</th>
	<th width='100px'>Código</th><th width='250px'>Nome</th>
	<th width='100px'>Valor</th><th width='100px'>Nome</th>
	<tr>";
	while($dados=mysqli_fetch_array($query)) 
	{
	
		echo "<tr>";
		echo "<td>". $dados['matricula']."</td>";
		echo "<td>". $dados['nome']."</td>";
		echo "<td>". $dados['endereco']."</td>";
		echo "<td>". $dados['cidade']."</td>";
		echo "<td>". $dados['codcurso']."</td>";		
		echo "</tr>";
		
		}
	echo "</table>";
	echo "</center>";
	mysqli_close($conexao);
?>
</body>
</html>
