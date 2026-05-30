<html>
<title> Semana 01 - Exemplo 04 </title>
<body>
<center>
<h3>Exemplo 04 - Listagem por Inicial de Nomes - Disciplina</h3>
</center>
<?php
	include_once('conexao.php');
	$nome = $_POST['inicial'];	
// ajustando a instrução select para ordenar por produto
$query = mysqli_query($conexao,"select * from curso where nome like '%$nome%'   order by nome");
	if (!$query)
	{
		die('Query Inválida: ' . @mysqli_error($conexao));  
	}
		echo"<center>";
	echo "<table border='1px'>";
	echo "<tr><th width='30px' align='center'>nome </th><th width='100px'>codcurso</th>
	<th width='250px'>coddisciplina01</th>
	<th width='100px'>coddisciplina02</th><th width='100px'>coddisciplina03</th>
	<tr>";
	while($dados=mysqli_fetch_array($query)) 
	{
	
		echo "<tr>";
		echo "<td>". $dados['nome']."</td>";
		echo "<td>". $dados['codcurso']."</td>";
		echo "<td>". $dados['coddisciplina01']."</td>";
		echo "<td>". $dados['coddisciplina02']."</td>";
		echo "<td>". $dados['coddisciplina03']."</td>";		
		echo "</tr>";
		
		}
	echo "</table>";
	echo "</center>";
	mysqli_close($conexao);
?>
</body>
</html>
