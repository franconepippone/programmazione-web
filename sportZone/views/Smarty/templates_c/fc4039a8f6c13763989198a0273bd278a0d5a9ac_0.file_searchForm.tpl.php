<?php
/* Smarty version 5.5.1, created on 2025-06-22 16:41:53
  from 'file:course/searchForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68581631585eb1_29610599',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc4039a8f6c13763989198a0273bd278a0d5a9ac' => 
    array (
      0 => 'course/searchForm.tpl',
      1 => 1750603201,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68581631585eb1_29610599 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazione-web\\sportZone\\views\\Smarty\\templates\\course';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Corsi Sportivi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 500px; margin: auto; }
        label { display: block; margin-top: 15px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; }
    </style>
</head>
<body>
    <h1>Ricerca Corsi Sportivi</h1>
    <form method="get" action="searchResults.php">
        <label for="durata">Durata (in settimane):</label>
        <input type="number" id="durata" name="durata" min="1" placeholder="Es. 4">

        <label for="data_inizio">Data di inizio:</label>
        <input type="date" id="data_inizio" name="data_inizio">

        <label for="data_fine">Data di fine:</label>
        <input type="date" id="data_fine" name="data_fine">

        <label for="costo">Costo massimo (€):</label>
        <input type="number" id="costo" name="costo" min="0" step="0.01" placeholder="Es. 100.00">

        <button type="submit">Cerca</button>
    </form>
</body>
</html><?php }
}
