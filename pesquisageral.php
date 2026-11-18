<?php
include_once('conexao.php');

//TERMO DE BUSCA (VEM DA URL, EX: pesquisageral.php?busca=ana). SEM BUSCA = LISTA TODOS
$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

//EXECUÇÃO DA CONSULTA SQL (JOIN BUSCA O NOME DO CURSO PELO CODIGO)
//COM A BUSCA VAZIA, O LIKE FICA '%%' E TRAZ TODOS OS ALUNOS
$stmt = mysqli_prepare($conexao,
  "SELECT a.matricula, a.nome, a.endereco, a.cidade, c.nome AS nome_curso
   FROM aluno a
   LEFT JOIN curso c ON c.codcurso = a.codcurso
   WHERE a.nome LIKE CONCAT('%', ?, '%')
   ORDER BY a.nome"
);
mysqli_stmt_bind_param($stmt, "s", $busca);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

if (!$query) {
  die('Erro ao buscar alunos. Tente novamente.');
}

//VERIFICAÇÃO E EXIBIÇÃO DOS RESULTADOS
$total = mysqli_num_rows($query);
?>
<?php $titulo = "Alunos"; include 'cabecalho.php'; ?>

  <div class="card">
    <div class="page-header">
      <h1>Alunos <span class="badge"><?php echo $total; ?> registros</span></h1>
      <?php if ($busca === ''): ?>
        <p>Todos os alunos cadastrados, ordenados por nome.</p>
      <?php else: ?>
        <p>Resultado para: <strong><?php echo htmlspecialchars($busca); ?></strong></p>
      <?php endif; ?>
    </div>

    <!-- Pesquisa por nome: envia para esta mesma pagina com ?busca=... -->
    <form class="busca" action="pesquisageral.php" method="GET">
      <input class="form-input" type="text" name="busca"
             value="<?php echo htmlspecialchars($busca); ?>"
             placeholder="Pesquisar aluno pelo nome...">
      <button type="submit" class="btn btn-primary">Pesquisar</button>
      <?php if ($busca !== ''): ?>
        <a href="pesquisageral.php" class="btn btn-ghost">Limpar</a>
      <?php endif; ?>
    </form>

    <?php if ($total == 0 && $busca !== ''): ?>
      <div class="msg msg-empty">
        Nenhum aluno encontrado com o nome <strong><?php echo htmlspecialchars($busca); ?></strong>.
      </div>
    <?php elseif ($total == 0): ?>
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
