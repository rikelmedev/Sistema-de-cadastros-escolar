<?php $titulo = ""; include 'cabecalho.php'; ?>

    <!-- SEÇÃO: Cadastros -->
    <div class="card">
      <div class="card-title">Cadastros</div>
      <div class="menu-grid">

        <a href="form_aluno.php" class="menu-link">
          <span class="icon">👤</span>
          <div>
            <div>Alunos</div>
            <div class="desc">Cadastrar novo aluno</div>
          </div>
        </a>

        <a href="form_curso.php" class="menu-link">
          <span class="icon">🎓</span>
          <div>
            <div>Cursos</div>
            <div class="desc">Cadastrar novo curso</div>
          </div>
        </a>

        <a href="form_disciplina.php" class="menu-link">
          <span class="icon">📚</span>
          <div>
            <div>Disciplinas</div>
            <div class="desc">Cadastrar nova disciplina</div>
          </div>
        </a>

      </div>
    </div>

    <!-- SEÇÃO: Pesquisar -->
    <div class="card">
      <div class="card-title">Pesquisar</div>
      <div class="menu-grid">

        <a href="pesquisageral.php" class="menu-link">
          <span class="icon">👥</span>
          <div>
            <div>Alunos</div>
            <div class="desc">Listar, pesquisar, editar e excluir</div>
          </div>
        </a>

        <a href="geralcurso.php" class="menu-link">
          <span class="icon">📋</span>
          <div>
            <div>Cursos</div>
            <div class="desc">Listar, pesquisar, editar e excluir</div>
          </div>
        </a>

        <a href="geraldisciplina.php" class="menu-link">
          <span class="icon">📖</span>
          <div>
            <div>Disciplinas</div>
            <div class="desc">Listar, pesquisar, editar e excluir</div>
          </div>
        </a>

      </div>
    </div>

<?php include 'rodape.php'; ?>
