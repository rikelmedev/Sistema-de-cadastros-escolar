<?php
include_once('conexao.php');

//BUSCA AS DISCIPLINAS UMA VEZ SO E GUARDA NUM ARRAY (USADO NAS 3 LISTAS)
$resultado   = mysqli_query($conexao, "SELECT coddisciplina, nome_disciplina FROM disciplina ORDER BY nome_disciplina");
$disciplinas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_close($conexao);

//MONTA AS OPCOES DE UMA LISTA DE DISCIPLINAS
function opcoes_disciplinas($disciplinas) {
  echo '<option value="">Selecione</option>';
  foreach ($disciplinas as $d) {
    echo '<option value="' . htmlspecialchars($d['coddisciplina']) . '">'
       . htmlspecialchars($d['coddisciplina'] . ' — ' . $d['nome_disciplina'])
       . '</option>';
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Cursos — Sistema Escolar</title>
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
      <div class="card-title">Cadastro de Cursos</div>

      <form action="cadcursos.php" method="POST">

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Código do Curso</label>
            <input class="form-input" type="text" name="codcurso"
                   placeholder="Ex: 101" required>
          </div>
          <div class="form-group">
            <label class="form-label">Nome do Curso</label>
            <input class="form-input" type="text" name="nomecurso"
                   placeholder="Ex: Informática" required>
          </div>
        </div>

        <div class="divider"></div>
        <div class="card-title">Disciplinas vinculadas</div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Disciplina 1</label>
            <select class="form-input" name="coddisciplina1" required>
              <?php opcoes_disciplinas($disciplinas); ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Disciplina 2</label>
            <select class="form-input" name="coddisciplina2" required>
              <?php opcoes_disciplinas($disciplinas); ?>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Disciplina 3</label>
            <select class="form-input" name="coddisciplina3" required>
              <?php opcoes_disciplinas($disciplinas); ?>
            </select>
          </div>
        </div>

        <div class="divider"></div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Cadastrar Curso</button>
          <button type="button" class="btn btn-ghost"
                  onclick="this.form.reset();">Limpar</button>
          <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
        </div>

      </form>
    </div>

  </div>
</body>
</html>