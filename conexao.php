<?php
//Mantem o comportamento classico do mysqli (retorna false em erro em vez de lancar excecao)
mysqli_report(MYSQLI_REPORT_OFF);

//CARREGA AS CREDENCIAIS DO BANCO (config.php fica fora do GitHub)
if (!file_exists(__DIR__ . '/config.php')) {
  die("Arquivo config.php não encontrado. Copie o config.example.php para config.php e preencha os dados do banco.");
}
require_once(__DIR__ . '/config.php');

$conexao = @mysqli_connect($host, $user, $pass, $banco)
or die("Problemas com a Conexão do Banco de Dados");
?>