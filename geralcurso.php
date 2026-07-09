<?php
include_once('conexao.php');

//EXECUÇÃO DA CONSULTA SQL
$query = mysqli_query($conexao, "SELECT * FROM curso ORDER BY nome");

if (!$query) {
  die('Erro ao buscar cursos. Tente novamente.');
}

//VERIFICAÇÃO E EXIBIÇÃO DOS RESULTADOS
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista Geral de Cursos — Sistema Escolar</title>
  <link rel="stylesheet" href="estilo.css">
</head>
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
    <div class="page-header">
      <h1>Lista Geral de Cursos <span class="badge"><?php echo $total; ?> registros</span></h1>
      <p>Todos os cursos cadastrados, ordenados por nome.</p>
    </div>

    <?php if ($total == 0): ?>
      <div class="msg msg-empty">Nenhum curso cadastrado.</div>
    <?php else: ?>
      <table class="result-table">
        <thead>
          <tr>
            <th>Cód. Curso</th>
            <th>Nome</th>
            <th>Disciplina 01</th>
            <th>Disciplina 02</th>
            <th>Disciplina 03</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($dados = mysqli_fetch_array($query)): ?>
          <tr>
            <td class="col-code"><?php echo $dados['codcurso']; ?></td>
            <td><?php echo $dados['nome']; ?></td>
            <td class="col-code"><?php echo $dados['coddisciplina01']; ?></td>
            <td class="col-code"><?php echo $dados['coddisciplina02']; ?></td>
            <td class="col-code"><?php echo $dados['coddisciplina03']; ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <?php mysqli_close($conexao); ?>

    <div class="divider"></div>
    <div class="btn-group">
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>