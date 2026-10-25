<?php
include_once('conexao.php');

//EXECUÇÃO DA CONSULTA SQL
//A TABELA DISCIPLINA ENTRA 3 VEZES (d1, d2, d3), UMA PARA CADA COLUNA DE DISCIPLINA DO CURSO
$query = mysqli_query($conexao,
  "SELECT c.codcurso, c.nome,
          d1.nome_disciplina AS disciplina1,
          d2.nome_disciplina AS disciplina2,
          d3.nome_disciplina AS disciplina3
   FROM curso c
   LEFT JOIN disciplina d1 ON d1.coddisciplina = c.coddisciplina01
   LEFT JOIN disciplina d2 ON d2.coddisciplina = c.coddisciplina02
   LEFT JOIN disciplina d3 ON d3.coddisciplina = c.coddisciplina03
   ORDER BY c.nome"
);

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
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($dados = mysqli_fetch_array($query)): ?>
          <tr>
            <td class="col-code"><?php echo htmlspecialchars($dados['codcurso']); ?></td>
            <td><?php echo htmlspecialchars($dados['nome']); ?></td>
            <td><?php echo htmlspecialchars($dados['disciplina1']); ?></td>
            <td><?php echo htmlspecialchars($dados['disciplina2']); ?></td>
            <td><?php echo htmlspecialchars($dados['disciplina3']); ?></td>
            <td>
              <!-- Editar abre o formulario preenchido; Excluir pede confirmacao antes de enviar -->
              <div class="acoes">
                <a href="editar_curso.php?codcurso=<?php echo urlencode($dados['codcurso']); ?>"
                   class="btn btn-ghost btn-sm">Editar</a>
                <form action="excluir_curso.php" method="POST"
                      onsubmit="return confirm('Excluir o curso <?php echo htmlspecialchars(addslashes($dados['nome'])); ?>?');">
                  <input type="hidden" name="codcurso" value="<?php echo htmlspecialchars($dados['codcurso']); ?>">
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