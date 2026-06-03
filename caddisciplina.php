<html>
<head>
      <title>Cadastro de Disciplinas</title>
</head>
<body>

<?php

include_once ('conexao.php');

//RECUPERAÇÃO DOS DADOS DO FORMULÁRIO
$codigo         = $_POST['coddisciplina'];
$nomedisciplina = $_POST['nomedisciplina'];

//CRIANDO LINAH DO INSERT
$sqlinsert = "insert into disciplina(coddisciplina, nome_disciplina) 
          VALUES ('$codigo','$nome')";

//EXECUÇÃO DO COMANDO E VERIFICAÇÃO DO RESULTADO
$resultado = mysqli_query($conexao, $sqlinsert);

if (!$resultado) {
  if (mysqli_errno($conexao) == 1062) {
    echo "<p>Código $codigo já cadastrado. Use outro.</p>";
  } else {
    echo "<p>Erro ao cadastrar. Tente novamente.</p>";
  }
} else {
  echo "<p>Disciplina $nomedisciplina cadastrada com sucesso!</p>";
}
 
mysqli_close($conexao);
?>

<br>
<br>
<input type='button' onclick="window.location='index.php';" VALUE ="Voltar ao Menu">
</body>
</html>
