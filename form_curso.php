<?php
include_once('conexao.php');

//BUSCA AS DISCIPLINAS PARA MONTAR AS CAIXAS DE MARCAR
$resultado   = mysqli_query($conexao, "SELECT coddisciplina, nome_disciplina FROM disciplina ORDER BY nome_disciplina");
$disciplinas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_close($conexao);
?>
<?php $titulo = "Cadastro de Cursos"; include 'cabecalho.php'; ?>

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

        <!-- Marque quantas disciplinas quiser (pelo menos uma).
             O nome disciplinas[] faz o PHP receber as marcadas como uma lista. -->
        <div class="check-grid">
          <?php foreach ($disciplinas as $d): ?>
          <label class="check-item">
            <input type="checkbox" name="disciplinas[]"
                   value="<?php echo htmlspecialchars($d['coddisciplina']); ?>">
            <?php echo htmlspecialchars($d['nome_disciplina']); ?>
          </label>
          <?php endforeach; ?>
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

<?php include 'rodape.php'; ?>
