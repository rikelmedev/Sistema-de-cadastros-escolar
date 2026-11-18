<?php
//CABECALHO COMPARTILHADO POR TODAS AS PAGINAS
//Antes de incluir, a pagina define $titulo (ex: "Lista Geral de Alunos").
//Se nao definir, a aba do navegador mostra so "Sistema Escolar".
$titulo_aba = empty($titulo) ? 'Sistema Escolar' : $titulo . ' — Sistema Escolar';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($titulo_aba); ?></title>
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
