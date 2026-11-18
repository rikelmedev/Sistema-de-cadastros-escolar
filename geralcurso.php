<?php
include_once('conexao.php');

//TERMO DE BUSCA (VEM DA URL, EX: geralcurso.php?busca=mec). SEM BUSCA = LISTA TODOS
$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

//EXECUÇÃO DA CONSULTA SQL
//A TABELA DISCIPLINA ENTRA 3 VEZES (d1, d2, d3), UMA PARA CADA COLUNA DE DISCIPLINA DO CURSO
//COM A BUSCA VAZIA, O LIKE FICA '%%' E TRAZ TODOS OS CURSOS
$stmt = mysqli_prepare($conexao,
  "SELECT c.codcurso, c.nome,
          d1.nome_disciplina AS disciplina1,
          d2.nome_disciplina AS disciplina2,
          d3.nome_disciplina AS disciplina3
   FROM curso c
   LEFT JOIN disciplina d1 ON d1.coddisciplina = c.coddisciplina01
   LEFT JOIN disciplina d2 ON d2.coddisciplina = c.coddisciplina02
   LEFT JOIN disciplina d3 ON d3.coddisciplina = c.coddisciplina03
   WHERE c.nome LIKE CONCAT('%', ?, '%')
   ORDER BY c.nome"
);
mysqli_stmt_bind_param($stmt, "s", $busca);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

if (!$query) {
  die('Erro ao buscar cursos. Tente novamente.');
}

//VERIFICAÇÃO E EXIBIÇÃO DOS RESULTADOS
$total = mysqli_num_rows($query);
?>
<?php $titulo = "Cursos"; include 'cabecalho.php'; ?>

  <div class="card">
    <div class="page-header">
      <h1>Cursos <span class="badge"><?php echo $total; ?> registros</span></h1>
      <?php if ($busca === ''): ?>
        <p>Todos os cursos cadastrados, ordenados por nome.</p>
      <?php else: ?>
        <p>Resultado para: <strong><?php echo htmlspecialchars($busca); ?></strong></p>
      <?php endif; ?>
    </div>

    <!-- Pesquisa por nome: envia para esta mesma pagina com ?busca=... -->
    <form class="busca" action="geralcurso.php" method="GET">
      <input class="form-input" type="text" name="busca"
             value="<?php echo htmlspecialchars($busca); ?>"
             placeholder="Pesquisar curso pelo nome...">
      <button type="submit" class="btn btn-primary">Pesquisar</button>
      <?php if ($busca !== ''): ?>
        <a href="geralcurso.php" class="btn btn-ghost">Limpar</a>
      <?php endif; ?>
    </form>

    <?php if ($total == 0 && $busca !== ''): ?>
      <div class="msg msg-empty">
        Nenhum curso encontrado com o nome <strong><?php echo htmlspecialchars($busca); ?></strong>.
      </div>
    <?php elseif ($total == 0): ?>
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

    <?php
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    ?>

    <div class="divider"></div>
    <div class="btn-group">
      <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
    </div>
  </div>

<?php include 'rodape.php'; ?>
