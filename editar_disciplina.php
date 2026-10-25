<?php
include_once('conexao.php');

//SE O FORMULARIO FOI ENVIADO (POST), SALVA AS ALTERACOES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $codigo         = $_POST['coddisciplina'];
  $nomedisciplina = $_POST['nomedisciplina'];

  //O CODIGO DA DISCIPLINA NAO MUDA: ELE SO IDENTIFICA QUAL DISCIPLINA ATUALIZAR
  $stmt = mysqli_prepare($conexao,
    "UPDATE disciplina SET nome_disciplina = ? WHERE coddisciplina = ?"
  );
  mysqli_stmt_bind_param($stmt, "ss", $nomedisciplina, $codigo);

  if (mysqli_stmt_execute($stmt)) {
    $msg_tipo  = "msg-success";
    $msg_texto = "Disciplina <strong>" . htmlspecialchars($nomedisciplina) . "</strong> atualizada com sucesso!";
  } else {
    $msg_tipo  = "msg-error";
    $msg_texto = "Erro ao atualizar. Tente novamente.";
  }
  mysqli_stmt_close($stmt);

//SE A PAGINA FOI ABERTA PELA LISTA (GET), BUSCA A DISCIPLINA PARA PREENCHER O FORMULARIO
} else {
  $codigo = isset($_GET['coddisciplina']) ? $_GET['coddisciplina'] : '';

  $stmt = mysqli_prepare($conexao, "SELECT * FROM disciplina WHERE coddisciplina = ?");
  mysqli_stmt_bind_param($stmt, "s", $codigo);
  mysqli_stmt_execute($stmt);
  $disciplina = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
  mysqli_stmt_close($stmt);

  if (!$disciplina) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Disciplina não encontrada.";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Disciplina — Sistema Escolar</title>
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

    <?php if (isset($msg_texto)): ?>
      <!-- Resultado da edicao (ou disciplina nao encontrada) -->
      <div class="page-header">
        <h1>Editar Disciplina</h1>
      </div>
      <div class="msg <?php echo $msg_tipo; ?>">
        <?php echo $msg_texto; ?>
      </div>
      <div class="divider"></div>
      <div class="btn-group">
        <a href="geraldisciplina.php" class="btn btn-primary">Voltar à Lista</a>
        <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
      </div>

    <?php else: ?>
      <!-- Formulario preenchido com os dados atuais da disciplina -->
      <div class="card-title">Editar Disciplina</div>

      <form action="editar_disciplina.php" method="POST">

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Código (não pode ser alterado)</label>
            <input class="form-input" type="text" name="coddisciplina"
                   value="<?php echo htmlspecialchars($disciplina['coddisciplina']); ?>" readonly>
          </div>
          <div class="form-group">
            <label class="form-label">Nome da Disciplina</label>
            <input class="form-input" type="text" name="nomedisciplina"
                   value="<?php echo htmlspecialchars($disciplina['nome_disciplina']); ?>" required>
          </div>
        </div>

        <div class="divider"></div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          <a href="geraldisciplina.php" class="btn btn-ghost">Cancelar</a>
        </div>

      </form>
    <?php endif; ?>

  </div>

</div>
</body>
</html>
<?php mysqli_close($conexao); ?>
