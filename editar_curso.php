<?php
include_once('conexao.php');

//SE O FORMULARIO FOI ENVIADO (POST), SALVA AS ALTERACOES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $codigo      = $_POST['codcurso'];
  $nomecurso   = $_POST['nomecurso'];
  //disciplinas[] CHEGA COMO LISTA COM OS CODIGOS DAS CAIXAS MARCADAS
  $disciplinas = isset($_POST['disciplinas']) ? array_unique((array) $_POST['disciplinas']) : array();

  if (count($disciplinas) == 0) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Marque pelo menos uma disciplina para o curso.";
  } else {
    //TRANSACAO: ATUALIZA O NOME E TROCA AS DISCIPLINAS DE UMA VEZ SO.
    //SE ALGO FALHAR NO MEIO, O ROLLBACK DEVOLVE O CURSO COMO ESTAVA.
    mysqli_begin_transaction($conexao);

    //O CODIGO DO CURSO NAO MUDA: ELE SO IDENTIFICA QUAL CURSO ATUALIZAR
    $stmt = mysqli_prepare($conexao, "UPDATE curso SET nome = ? WHERE codcurso = ?");
    mysqli_stmt_bind_param($stmt, "ss", $nomecurso, $codigo);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //APAGA AS LIGACOES ANTIGAS E GRAVA AS MARCADAS AGORA
    if ($ok) {
      $stmt = mysqli_prepare($conexao, "DELETE FROM curso_disciplina WHERE codcurso = ?");
      mysqli_stmt_bind_param($stmt, "s", $codigo);
      $ok = mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }

    $erro = 0;
    if ($ok) {
      $stmt = mysqli_prepare($conexao, "INSERT INTO curso_disciplina (codcurso, coddisciplina) VALUES (?, ?)");
      foreach ($disciplinas as $coddisciplina) {
        mysqli_stmt_bind_param($stmt, "ss", $codigo, $coddisciplina);
        if (!mysqli_stmt_execute($stmt)) {
          $ok   = false;
          $erro = mysqli_stmt_errno($stmt);
          break;
        }
      }
      mysqli_stmt_close($stmt);
    }

    if ($ok) {
      mysqli_commit($conexao);
      $msg_tipo  = "msg-success";
      $msg_texto = "Curso <strong>" . htmlspecialchars($nomecurso) . "</strong> atualizado com sucesso!";
    } else {
      mysqli_rollback($conexao);
      $msg_tipo = "msg-error";
      if ($erro == 1452) {
        //1452 = ALGUM CODIGO DE DISCIPLINA NAO EXISTE NA TABELA DISCIPLINA
        $msg_texto = "Uma ou mais disciplinas informadas não existem. Confira a lista de disciplinas.";
      } else {
        $msg_texto = "Erro ao atualizar. Tente novamente.";
      }
    }
  }

//SE A PAGINA FOI ABERTA PELA LISTA (GET), BUSCA O CURSO PARA PREENCHER O FORMULARIO
} else {
  $codigo = isset($_GET['codcurso']) ? $_GET['codcurso'] : '';

  $stmt = mysqli_prepare($conexao, "SELECT * FROM curso WHERE codcurso = ?");
  mysqli_stmt_bind_param($stmt, "s", $codigo);
  mysqli_stmt_execute($stmt);
  $curso = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
  mysqli_stmt_close($stmt);

  if (!$curso) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Curso não encontrado.";
  } else {
    //TODAS AS DISCIPLINAS, PARA MONTAR AS CAIXAS DE MARCAR
    $resultado   = mysqli_query($conexao, "SELECT coddisciplina, nome_disciplina FROM disciplina ORDER BY nome_disciplina");
    $disciplinas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    //CODIGOS DAS DISCIPLINAS QUE O CURSO JA TEM (ESSAS CAIXAS VEM MARCADAS)
    $stmt = mysqli_prepare($conexao, "SELECT coddisciplina FROM curso_disciplina WHERE codcurso = ?");
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    mysqli_stmt_execute($stmt);
    $marcadas = array_column(mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC), 'coddisciplina');
    mysqli_stmt_close($stmt);
  }
}
?>
<?php $titulo = "Editar Curso"; include 'cabecalho.php'; ?>

  <div class="card">

    <?php if (isset($msg_texto)): ?>
      <!-- Resultado da edicao (ou curso nao encontrado) -->
      <div class="page-header">
        <h1>Editar Curso</h1>
      </div>
      <div class="msg <?php echo $msg_tipo; ?>">
        <?php echo $msg_texto; ?>
      </div>
      <div class="divider"></div>
      <div class="btn-group">
        <a href="geralcurso.php" class="btn btn-primary">Voltar à Lista</a>
        <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
      </div>

    <?php else: ?>
      <!-- Formulario preenchido com os dados atuais do curso -->
      <div class="card-title">Editar Curso</div>

      <form action="editar_curso.php" method="POST">

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Código do Curso (não pode ser alterado)</label>
            <input class="form-input" type="text" name="codcurso"
                   value="<?php echo htmlspecialchars($curso['codcurso']); ?>" readonly>
          </div>
          <div class="form-group">
            <label class="form-label">Nome do Curso</label>
            <input class="form-input" type="text" name="nomecurso"
                   value="<?php echo htmlspecialchars($curso['nome']); ?>" required>
          </div>
        </div>

        <div class="divider"></div>
        <div class="card-title">Disciplinas vinculadas</div>

        <!-- As disciplinas que o curso ja tem vem marcadas; marque ou desmarque a vontade -->
        <div class="check-grid">
          <?php foreach ($disciplinas as $d): ?>
          <label class="check-item">
            <input type="checkbox" name="disciplinas[]"
                   value="<?php echo htmlspecialchars($d['coddisciplina']); ?>"
                   <?php if (in_array($d['coddisciplina'], $marcadas)) echo 'checked'; ?>>
            <?php echo htmlspecialchars($d['nome_disciplina']); ?>
          </label>
          <?php endforeach; ?>
        </div>

        <div class="divider"></div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          <a href="geralcurso.php" class="btn btn-ghost">Cancelar</a>
        </div>

      </form>
    <?php endif; ?>

  </div>

<?php include 'rodape.php'; ?>
<?php mysqli_close($conexao); ?>
