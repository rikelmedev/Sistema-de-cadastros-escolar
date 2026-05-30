<html>
<title> Semana 01 - Exemplo 04 </title>
<body>
<center>
<h3>Exemplo 04 - Listagem Geral de Nomes - Disciplina</h3>
</center>
<?php
	include_once('conexao.php');
// ajustando a instrução select para ordenar por produto
$query = mysqli_query($conexao,"select * from disciplina order by nome_disciplina");
	if (!$query)
	{
		die('Query Inválida: ' . @mysqli_error($conexao));  
	}
		echo"<center>";
	echo "<table border='1px'>";
	echo "<tr><th width='100px'>Código</th><th width='100px'>nome_disciplina</th><tr>";
	while($dados=mysqli_fetch_array($query)) 
	{
	
		echo "<tr>";
		echo "<td>". $dados['coddisciplina']."</td>";
		echo "<td>". $dados['nome_disciplina']."</td>";
				
		echo "</tr>";
		
		}
	echo "</table>";
	echo "</center>";
	mysqli_close($conexao);
?>
</body>
</html>
