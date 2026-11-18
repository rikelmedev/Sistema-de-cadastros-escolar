<?php
include_once('conexao.php');

//BUSCA OS CURSOS PARA PREENCHER A LISTA DE SELECAO
$cursos = mysqli_query($conexao, "SELECT codcurso, nome FROM curso ORDER BY nome");
?>
<?php $titulo = "Cadastro de Alunos"; include 'cabecalho.php'; ?>

    <div class="card">
      <div class="card-title">Cadastro de Alunos</div>

      <form action="cadalunos.php" method="POST">

        <!-- Linha com matrícula e curso lado a lado -->
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Matrícula</label>
            
            <input class="form-input" type="text" name="matricula"
                   placeholder="Ex: 2025001" required>
          </div>
          <div class="form-group">
            <label class="form-label">Curso</label>
            <!-- Lista preenchida com os cursos do banco; envia o codigo do curso escolhido -->
            <select class="form-input" name="codcurso" required>
              <option value="">Selecione o curso</option>
              <?php while ($curso = mysqli_fetch_assoc($cursos)): ?>
              <option value="<?php echo htmlspecialchars($curso['codcurso']); ?>">
                <?php echo htmlspecialchars($curso['codcurso'] . ' — ' . $curso['nome']); ?>
              </option>
              <?php endwhile; ?>
            </select>
            <?php mysqli_close($conexao); ?>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Nome Completo</label>
          <input class="form-input" type="text" name="nome"
                 placeholder="Nome do aluno" required>
        </div>

        <div class="form-group">
          <label class="form-label">Endereço</label>
          <input class="form-input" type="text" name="endereco"
                 placeholder="Rua, número, bairro" required>
        </div>

        <div class="form-group">
          <label class="form-label">Cidade</label>
          <input class="form-input" type="text" name="cidade"
                 placeholder="Cidade" required>
        </div>

        <div class="divider"></div>

        <div class="btn-group">
          <!-- Envia os dados para cadalunos.php -->
          <button type="submit" class="btn btn-primary">Cadastrar Aluno</button>

          <button type="button" class="btn btn-ghost"
                  onclick="this.form.reset();">Limpar</button>
          <a href="index.php" class="btn btn-ghost">Voltar ao Menu</a>
        </div>

      </form>
    </div>

<?php include 'rodape.php'; ?>
