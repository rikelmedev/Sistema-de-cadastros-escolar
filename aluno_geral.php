<html>
<title> Semana 01 - Exemplo 04 </title>
<body>
<center>
<h3>Exemplo 04 - Listagem Geral de Nomes - Alunos</h3>
</center>
<?php
	include_once('conexao.php');
// ajustando a instrução select para ordenar por produto
$nome = $_POST['inicial'];
$query = mysqli_query($conexao,"select * from aluno where nome like '%$nome%'   order by nome");
	if (!$query)
	{
		die('Query Inválida: ' . @mysqli_error($conexao));  
	}
		echo"<center>";
	echo "<table border='1px'>";
	echo "<tr><th width='30px' align='center'>nome</th>	<th width='100px'>matricula</th>
	<th width='250px'>endereco</th>
	<th width='100px'>cidade</th><th width='100px'>codcurso</th>
	<tr>";
	while($dados=mysqli_fetch_array($query)) 
	{
	
		echo "<tr>";
		echo "<td>". $dados['nome']."</td>";
		echo "<td>". $dados['matricula']."</td>";
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
