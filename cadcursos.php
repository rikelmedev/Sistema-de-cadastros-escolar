<html>
<head>
     <title>Cadastro de Cursos</title>
</head>
<body>

<?php

include_once ('conexao.php');

//RECUPERAÇÃO DOS DADOS DO FORMULÁRIO
$codigo = $_POST['codcurso'];
$nome = $_POST['nomecurso'];
$cod1 = $_POST['coddisciplina1'];
$cod2 = $_POST['coddisciplina2'];
$cod3 = $_POST['coddisciplina3'];


//criando linha de insert
$sqlinsert = "insert into curso(codcurso, nome, coddisciplina01, coddisciplina02, coddisciplina03)
VALUES ('$codigo', '$nome', '$cod1', '$cod2', '$cod3')";


//EXECUÇÃO E VERIFICAÇÃO DO RESULTADO
$resultado = @mysqli_query($conexao, $sqlinsert);

if (!$resultado){

if (@mysqli_error($conexao) == 1062){
   echo "<p>Código <strong>$codigo</strong> já esta cadastrado.
   Use um codigo de curso diferente.</p>";
   
   } else { 
   echo "<p>Erro ao realizar o cadastro. Tente novamente.</p>";
   }
   
   } else { 
   echo "<p>Curso <strong>$nomecurso</strong> cadastrado com sucesso!</p>";
   }

   mysqli_close($conexao);
?>

<br>
<br>
<input type='button' onclick="window.location='index.php';" VALUE ="Voltar ao Menu">

</body>
</html>
