<?php
include_once('conexao.php');

//RECUPERAÇÃO DO TERMO DE BUSCA
$busca = $_POST['inicial'];

//EXECUÇÃO DA CONSULTA SQL (PREPARED STATEMENT)
$stmt = mysqli_prepare($conexao,
  "SELECT * FROM curso WHERE nome LIKE CONCAT('%', ?, '%') ORDER BY nome"
);
mysqli_stmt_bind_param($stmt, "s", $busca);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

if (!$query) {
  die('Erro ao realizar a pesquisa. Tente novamente.');
}

//VERIFICAÇÃO E EXIBIÇÃO DOS RESULTADOS
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pesquisa de Cursos — Sistema Escolar</title>
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
      <h1>Pesquisa de Cursos <span class="badge"><?php echo $total; ?> resultado(s)</span></h1>
      <p>Resultado para: <strong><?php echo htmlspecialchars($busca); ?></strong></p>
    </div>

    <?php if ($total == 0): ?>
      <div class="msg msg-empty">
        Nenhum curso encontrado com o nome <strong><?php echo htmlspecialchars($busca); ?></strong>.
      </div>
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
            <td class="col-code"><?php echo htmlspecialchars($dados['codcurso']); ?></td>
            <td><?php echo htmlspecialchars($dados['nome']); ?></td>
            <td class="col-code"><?php echo htmlspecialchars($dados['coddisciplina01']); ?></td>
            <td class="col-code"><?php echo htmlspecialchars($dados['coddisciplina02']); ?></td>
            <td class="col-code"><?php echo htmlspecialchars($dados['coddisciplina03']); ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <?php
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    ?>

    <div class="divider"></div>
    <div class="btn-group">
      <a href="consulta_curso.html" class="btn btn-ghost">Nova Pesquisa</a>
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

</div>
</body>
</html>