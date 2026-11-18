<?php $titulo = "Cadastro de Disciplinas"; include 'cabecalho.php'; ?>

    <div class="card">
      <div class="card-title">Cadastro de Disciplinas</div>

      <form action="caddisciplina.php" method="POST">

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Código da Disciplina</label>
            <input class="form-input" type="text" name="coddisciplina"
                   placeholder="Ex: 1" required>
          </div>
          <div class="form-group">
            <label class="form-label">Nome da Disciplina</label>
            <input class="form-input" type="text" name="nomedisciplina"
                   placeholder="Ex: Matemática" required>
          </div>
        </div>

        <div class="divider"></div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Cadastrar Disciplina</button>
          <button type="button" class="btn btn-ghost"
                  onclick="this.form.reset();">Limpar</button>
          <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
        </div>

      </form>
    </div>

<?php include 'rodape.php'; ?>
