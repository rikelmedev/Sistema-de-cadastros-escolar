<?php
//Mantem o comportamento classico do mysqli (retorna false em erro em vez de lancar excecao)
mysqli_report(MYSQLI_REPORT_OFF);

$host = "localhost";
$user = "root";
$pass = "";
$banco = "escola";
$conexao = @mysqli_connect($host, $user, $pass, $banco)
or die("Problemas com a Conexão do Banco de Dados");
?>