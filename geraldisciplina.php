<html>
<head>
     <title> Listagem Geral de Disciplina </title>
     <link rel="stylesheet" href="estilo.css">
</heade>
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

<?php
include_once('conexao.php');

// AJUSTANDO A INSTRUÇÃO DE CONSULTA SQL
$query = mysqli_query($conexao,"select * from disciplina order by nome_disciplina");
	
if (!$query) die('Erro ao consulta disciplinas. Tente Novamente.');  
	$total = mysqli_num_rows($query);
?>

<div class="page-header">
    <h1>Lista Geral de Disciplinas
        <span class="badge"><?php echo $total; ?> registros</span>
    </h1>
    <p>Todas as disciplinas cadastradas, ordenadas por nome.</p>
    </div>
	    
    <?php if ($total == 0): ?>
      <div class="msg msg-empty">Nenhuma disciplina cadastrada.</div>
    <?php else: ?>	

	  <table class="result-table">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome da Disciplina</th>
          </tr>
        </thead>
  <tbody>
	<?php while($d = mysqli_fetch_array($query)): ?>
		<tr>
		  <td class="col-code"><?php echo $d['coddisciplina']; ?></td>
		  <td><?php echo $d['nome_disciplina']; ?></td>
		</tr>
	<?php endwhile; ?>
  </tody>
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
