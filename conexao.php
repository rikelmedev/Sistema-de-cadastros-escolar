<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "escola";
$conexao = @mysqli_connect($host, $user, $pass, $banco) 
or die("Problemas com a Conexão do Banco de Dados");
?>