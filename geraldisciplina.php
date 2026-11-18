<?php
include_once('conexao.php');

//TERMO DE BUSCA (VEM DA URL, EX: geraldisciplina.php?busca=banco). SEM BUSCA = LISTA TODAS
$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

//EXECUÇÃO DA CONSULTA SQL
//COM A BUSCA VAZIA, O LIKE FICA '%%' E TRAZ TODAS AS DISCIPLINAS
$stmt = mysqli_prepare($conexao,
  "SELECT * FROM disciplina
   WHERE nome_disciplina LIKE CONCAT('%', ?, '%')
   ORDER BY nome_disciplina"
);
mysqli_stmt_bind_param($stmt, "s", $busca);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

if (!$query) {
  die('Erro ao buscar disciplinas. Tente novamente.');
}

//VERIFICAÇÃO E EXIBIÇÃO DOS RESULTADOS
$total = mysqli_num_rows($query);
?>
<?php $titulo = "Disciplinas"; include 'cabecalho.php'; ?>

  <div class="card">
    <div class="page-header">
      <h1>Disciplinas <span class="badge"><?php echo $total; ?> registros</span></h1>
      <?php if ($busca === ''): ?>
        <p>Todas as disciplinas cadastradas, ordenadas por nome.</p>
      <?php else: ?>
        <p>Resultado para: <strong><?php echo htmlspecialchars($busca); ?></strong></p>
      <?php endif; ?>
    </div>

    <!-- Pesquisa por nome: envia para esta mesma pagina com ?busca=... -->
    <form class="busca" action="geraldisciplina.php" method="GET">
      <input class="form-input" type="text" name="busca"
             value="<?php echo htmlspecialchars($busca); ?>"
             placeholder="Pesquisar disciplina pelo nome...">
      <button type="submit" class="btn btn-primary">Pesquisar</button>
      <?php if ($busca !== ''): ?>
        <a href="geraldisciplina.php" class="btn btn-ghost">Limpar</a>
      <?php endif; ?>
    </form>

    <?php if ($total == 0 && $busca !== ''): ?>
      <div class="msg msg-empty">
        Nenhuma disciplina encontrada com o nome <strong><?php echo htmlspecialchars($busca); ?></strong>.
      </div>
    <?php elseif ($total == 0): ?>
      <div class="msg msg-empty">Nenhuma disciplina cadastrada.</div>
    <?php else: ?>
      <table class="result-table">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome da Disciplina</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($dados = mysqli_fetch_array($query)): ?>
          <tr>
            <td class="col-code"><?php echo htmlspecialchars($dados['coddisciplina']); ?></td>
            <td><?php echo htmlspecialchars($dados['nome_disciplina']); ?></td>
            <td>
              <!-- Editar abre o formulario preenchido; Excluir pede confirmacao antes de enviar -->
              <div class="acoes">
                <a href="editar_disciplina.php?coddisciplina=<?php echo urlencode($dados['coddisciplina']); ?>"
                   class="btn btn-ghost btn-sm">Editar</a>
                <form action="excluir_disciplina.php" method="POST"
                      onsubmit="return confirm('Excluir a disciplina <?php echo htmlspecialchars(addslashes($dados['nome_disciplina'])); ?>?');">
                  <input type="hidden" name="coddisciplina" value="<?php echo htmlspecialchars($dados['coddisciplina']); ?>">
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
