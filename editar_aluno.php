<?php
include_once('conexao.php');

//SE O FORMULARIO FOI ENVIADO (POST), SALVA AS ALTERACOES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $matricula = $_POST['matricula'];
  $nome      = $_POST['nome'];
  $endereco  = $_POST['endereco'];
  $cidade    = $_POST['cidade'];
  $curso     = $_POST['codcurso'];

  //A MATRICULA NAO MUDA: ELA SO IDENTIFICA QUAL ALUNO ATUALIZAR
  $stmt = mysqli_prepare($conexao,
    "UPDATE aluno SET nome = ?, endereco = ?, cidade = ?, codcurso = ? WHERE matricula = ?"
  );
  mysqli_stmt_bind_param($stmt, "sssss", $nome, $endereco, $cidade, $curso, $matricula);

  if (mysqli_stmt_execute($stmt)) {
    $msg_tipo  = "msg-success";
    $msg_texto = "Aluno <strong>" . htmlspecialchars($nome) . "</strong> atualizado com sucesso!";
  } elseif (mysqli_stmt_errno($stmt) == 1452) {
    //1452 = CODIGO DO CURSO NAO EXISTE NA TABELA CURSO
    $msg_tipo  = "msg-error";
    $msg_texto = "Curso <strong>" . htmlspecialchars($curso) . "</strong> não existe. Confira o código na lista de cursos.";
  } else {
    $msg_tipo  = "msg-error";
    $msg_texto = "Erro ao atualizar. Tente novamente.";
  }
  mysqli_stmt_close($stmt);

//SE A PAGINA FOI ABERTA PELA LISTA (GET), BUSCA O ALUNO PARA PREENCHER O FORMULARIO
} else {
  $matricula = isset($_GET['matricula']) ? $_GET['matricula'] : '';

  $stmt = mysqli_prepare($conexao, "SELECT * FROM aluno WHERE matricula = ?");
  mysqli_stmt_bind_param($stmt, "s", $matricula);
  mysqli_stmt_execute($stmt);
  $aluno = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
  mysqli_stmt_close($stmt);

  if (!$aluno) {
    $msg_tipo  = "msg-error";
    $msg_texto = "Aluno não encontrado.";
  } else {
    //BUSCA OS CURSOS PARA PREENCHER A LISTA DE SELECAO
    $cursos = mysqli_query($conexao, "SELECT codcurso, nome FROM curso ORDER BY nome");
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Aluno — Sistema Escolar</title>
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
      <!-- Resultado da edicao (ou aluno nao encontrado) -->
      <div class="page-header">
        <h1>Editar Aluno</h1>
      </div>
      <div class="msg <?php echo $msg_tipo; ?>">
        <?php echo $msg_texto; ?>
      </div>
      <div class="divider"></div>
      <div class="btn-group">
        <a href="pesquisageral.php" class="btn btn-primary">Voltar à Lista</a>
        <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
      </div>

    <?php else: ?>
      <!-- Formulario preenchido com os dados atuais do aluno -->
      <div class="card-title">Editar Aluno</div>

      <form action="editar_aluno.php" method="POST">

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Matrícula (não pode ser alterada)</label>
            <input class="form-input" type="text" name="matricula"
                   value="<?php echo htmlspecialchars($aluno['matricula']); ?>" readonly>
          </div>
          <div class="form-group">
            <label class="form-label">Curso</label>
            <select class="form-input" name="codcurso" required>
              <?php while ($curso = mysqli_fetch_assoc($cursos)): ?>
              <option value="<?php echo htmlspecialchars($curso['codcurso']); ?>"
                <?php if ($curso['codcurso'] == $aluno['codcurso']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($curso['codcurso'] . ' — ' . $curso['nome']); ?>
              </option>
              <?php endwhile; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Nome Completo</label>
          <input class="form-input" type="text" name="nome"
                 value="<?php echo htmlspecialchars($aluno['nome']); ?>" required>
        </div>

        <div class="form-group">
          <label class="form-label">Endereço</label>
          <input class="form-input" type="text" name="endereco"
                 value="<?php echo htmlspecialchars($aluno['endereco']); ?>" required>
        </div>

        <div class="form-group">
          <label class="form-label">Cidade</label>
          <input class="form-input" type="text" name="cidade"
                 value="<?php echo htmlspecialchars($aluno['cidade']); ?>" required>
        </div>

        <div class="divider"></div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          <a href="pesquisageral.php" class="btn btn-ghost">Cancelar</a>
        </div>

      </form>
    <?php endif; ?>

  </div>

</div>
</body>
</html>
<?php mysqli_close($conexao); ?>
