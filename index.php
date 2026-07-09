<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Escolar</title>

  <link rel="stylesheet" href="estilo.css">
</head>
<body>

  <div class="container">

    <!-- Cabeçalho com logo e nome do sistema -->
    <div class="sys-header">
      <div class="sys-logo">SE</div>
      <div>
        <div class="sys-title">Sistema Escolar</div>
        <div class="sys-subtitle">Gestão de alunos, cursos e disciplinas</div>
      </div>
    </div>

    <!-- SEÇÃO: Cadastros -->
    <div class="card">
      <div class="card-title">Cadastros</div>
      <div class="menu-grid">

        <a href="cadalunos.html" class="menu-link">
          <span class="icon">👤</span>
          <div>
            <div>Alunos</div>
            <div class="desc">Cadastrar novo aluno</div>
          </div>
        </a>

        <a href="cadcurso.html" class="menu-link">
          <span class="icon">🎓</span>
          <div>
            <div>Cursos</div>
            <div class="desc">Cadastrar novo curso</div>
          </div>
        </a>

        <a href="caddisciplina.html" class="menu-link">
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
            <div>Alunos — Lista Geral</div>
            <div class="desc">Ver todos os alunos</div>
          </div>
        </a>

        <a href="consulta_aluno.html" class="menu-link">
          <span class="icon">🔍</span>
          <div>
            <div>Alunos — Pesquisa</div>
            <div class="desc">Buscar aluno por nome</div>
          </div>
        </a>

        <a href="geralcurso.php" class="menu-link">
          <span class="icon">📋</span>
          <div>
            <div>Cursos — Lista Geral</div>
            <div class="desc">Ver todos os cursos</div>
          </div>
        </a>

        <a href="consulta_curso.html" class="menu-link">
          <span class="icon">🔍</span>
          <div>
            <div>Cursos — Pesquisa</div>
            <div class="desc">Buscar curso por nome</div>
          </div>
        </a>

        <a href="geraldisciplina.php" class="menu-link">
          <span class="icon">📖</span>
          <div>
            <div>Disciplinas — Lista Geral</div>
            <div class="desc">Ver todas as disciplinas</div>
          </div>
        </a>

        <a href="consulta_disciplina.html" class="menu-link">
          <span class="icon">🔍</span>
          <div>
            <div>Disciplinas — Pesquisa</div>
            <div class="desc">Buscar disciplina por nome</div>
          </div>
        </a>

      </div>
    </div>

  </div>

</body>
</html>