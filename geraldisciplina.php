<?php
include_once('conexao.php');

//EXECUÇÃO DA CONSULTA SQL
$query = mysqli_query($conexao, "SELECT * FROM disciplina ORDER BY nome_disciplina");

if (!$query) {
  die('Erro ao buscar disciplinas. Tente novamente.');
}

//VERIFICAÇÃO E EXIBIÇÃO DOS RESULTADOS
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista Geral de Disciplinas — Sistema Escolar</title>
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
      <h1>Lista Geral de Disciplinas <span class="badge"><?php echo $total; ?> registros</span></h1>
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
          <?php while ($dados = mysqli_fetch_array($query)): ?>
          <tr>
            <td class="col-code"><?php echo htmlspecialchars($dados['coddisciplina']); ?></td>
            <td><?php echo htmlspecialchars($dados['nome_disciplina']); ?></td>
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