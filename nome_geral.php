<html>
<title> Semana 01 - Exemplo 04 </title>
<body>
<center>
<h3>Exemplo 04 - Listagem por Inicial de Nomes - Disciplina</h3>
</center>
<?php
	include_once('conexao.php');
	$nome_disciplina = $_POST['inicial'];	
// ajustando a instrução select para ordenar por produto
$query = mysqli_query($conexao,"select * from disciplina where nome_disciplina like '%$nome_disciplina%'   order by nome_disciplina");
	if (!$query)
	{
		die('Query Inválida: ' . @mysqli_error($conexao));  
	}
		echo"<center>";
	echo "<table border='1px'>";
	echo "<tr><th width='30px' align='center'>nome_disciplina</th>	<th width='100px'>coddisciplina</th>
	<tr>";
	while($dados=mysqli_fetch_array($query)) 
	{
	
		echo "<tr>";
		echo "<td>". $dados['nome_disciplina']."</td>";
		echo "<td>". $dados['coddisciplina']."</td>";	
		echo "</tr>";
		
		}
	echo "</table>";
	echo "</center>";
	mysqli_close($conexao);
?>
</body>
</html>
