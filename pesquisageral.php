<?php
include_once('conexao.php');

//EXECUÇÃO DA CONSULTA SQL (JOIN BUSCA O NOME DO CURSO PELO CODIGO)
$query = mysqli_query($conexao,
  "SELECT a.matricula, a.nome, a.endereco, a.cidade, c.nome AS nome_curso
   FROM aluno a
   LEFT JOIN curso c ON c.codcurso = a.codcurso
   ORDER BY a.nome"
);

if (!$query) {
  die('Erro ao buscar alunos. Tente novamente.');
}

//VERIFICAÇÃO E EXIBIÇÃO DOS RESULTADOS
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista Geral de Alunos — Sistema Escolar</title>
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
      <h1>Lista Geral de Alunos <span class="badge"><?php echo $total; ?> registros</span></h1>
      <p>Todos os alunos cadastrados, ordenados por nome.</p>
    </div>

    <?php if ($total == 0): ?>
      <div class="msg msg-empty">Nenhum aluno cadastrado.</div>
    <?php else: ?>
      <table class="result-table">
        <thead>
          <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Cidade</th>
            <th>Curso</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($dados = mysqli_fetch_array($query)): ?>
          <tr>
            <td class="col-code"><?php echo htmlspecialchars($dados['matricula']); ?></td>
            <td><?php echo htmlspecialchars($dados['nome']); ?></td>
            <td><?php echo htmlspecialchars($dados['endereco']); ?></td>
            <td><?php echo htmlspecialchars($dados['cidade']); ?></td>
            <td><?php echo htmlspecialchars($dados['nome_curso']); ?></td>
            <td>
              <!-- Editar abre o formulario preenchido; Excluir pede confirmacao antes de enviar -->
              <div class="acoes">
                <a href="editar_aluno.php?matricula=<?php echo urlencode($dados['matricula']); ?>"
                   class="btn btn-ghost btn-sm">Editar</a>
                <form action="excluir_aluno.php" method="POST"
                      onsubmit="return confirm('Excluir o aluno <?php echo htmlspecialchars(addslashes($dados['nome'])); ?>?');">
                  <input type="hidden" name="matricula" value="<?php echo htmlspecialchars($dados['matricula']); ?>">
                  <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
              </div>
            </td>
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