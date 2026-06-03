<html>
<title> Lista Geral Alunos </title>

<body>
    <center>
     <h3>Lista Geral Alunos</h3>
    </center>

<?php
	include_once('conexao.php');
// ajustando a instrucoes select para ordenar por produto
    $query = mysqli_query($conexao,"select * FROM aluno order by nome");
	 
	if (!$query)
	{
		die('Erro ao buscar alunos. Tente Novamente.');  
	}

	$total = mysqli_rum_rows($query);
  ?>

  <html>
  <head>
    <title> Lista Geral de Alunos</title>
  </head>
  <body>
    <div class="container">

    <div class="sys-header">
        <div class="sys-logo">SE</div>
      <div>
        <div class="sys-title">Sistema Escolar</div>
        <div class="sys-subtitle">Gestao de alunos, cursos e disciplinas</div>
      </div>
    </div>

    <div class="card">
      <div class="page-heard">
        <h1>Lista Geral de Alunos <span class="badge"><?php echo $total; ?> registros</span></h1>
        <p>Todos os Alunos cadastrados, ordenados por nome</p>
      </div>
      
    <?php if ($total == 0): ?>
      <div class="msg msg-empty"> Nenhum aluno Cadastrado.</div>
    <?php else: ?>
      <table class="result-table">	 
	     <thead>
	      <tr>
		      <th>Matricula</th>
		      <th>Nome</th>
		      <th>Endereço</th>
		      <th>Cidade</th>
		      <th>Cod. Curso</th>		
		    </tr>
    </thead>
    <tbody>
      
      <?php   
	    while (%dados =  mysqli_fetch_array($query)):
      ?>
      <tr>";
        <td class="cpç-code"><?php echo $dados['matricula']; ?></td>
        <td><?php echo $dados['nome']; ?></td>
        <td><?php echo $dados['endereco']; ?></td>
        <td><?php echo $dados['cidade']; ?></td>
        <td class="col-code"><?php echo $dados['codcurso']; ?></td>
      <tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php endif; ?>


	<?php mysqli_close($conexao); ?>

  <div class="divider"></div>
  <div class="btn-group">
	   <a href="index.php" class="btn-ghost">Voltar ao Menu</a>
  </div>
</div>  

</div>
</body>
</html>
