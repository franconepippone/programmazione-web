<?php
/* Smarty version 5.5.1, created on 2025-06-24 15:03:05
  from 'file:course/searchForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685aa209487ef0_28249481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc4039a8f6c13763989198a0273bd278a0d5a9ac' => 
    array (
      0 => 'course/searchForm.tpl',
      1 => 1750770181,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685aa209487ef0_28249481 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazione-web\\sportZone\\views\\Smarty\\templates\\course';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Corsi Sportivi</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
    <div class="form-wrapper" id="search-course-form-wrapper">
        <h2>Ricerca Corsi Sportivi</h2>
        <form method="post" action="/course/showCourses" id="search-course-form">
            <div class="form-group">
                <label for="title">Titolo:</label>
                <input type="text" id="title" name="title" class="input-text" placeholder="Titolo corso">
            </div>

            <div class="form-group">
                <label for="startDate">Data di inizio:</label>
                <input type="date" id="startDate" name="startDate" class="input-date">
            </div>

            <div class="form-group">
                <label for="endDate">Data di fine:</label>
                <input type="date" id="endDate" name="endDate" class="input-date">
            </div>

            <div class="form-group">
                <label for="description">Descrizione:</label>
                <input type="text" id="description" name="description" class="input-text" placeholder="Descrizione">
            </div>

            <div class="form-group">
                <label for="timeSlot">Fascia oraria (es. 09:00-11:00):</label>
                <input type="text" id="timeSlot" name="timeSlot" class="input-text" pattern="^\d<?php echo 2;?>
:\d<?php echo 2;?>
-\d<?php echo 2;?>
:\d<?php echo 2;?>
$" placeholder="HH:MM-HH:MM">
            </div>

            <div class="form-group">
                <label for="cost">Costo massimo (€):</label>
                <input type="number" id="cost" name="cost" class="input-number" min="0" step="0.01" placeholder="Es. 100.00">
            </div>

            <div class="form-group">
                <label for="MaxParticipantsCount">Numero massimo partecipanti:</label>
                <input type="number" id="MaxParticipantsCount" name="MaxParticipantsCount" class="input-number" min="1" placeholder="Es. 20">
            </div>

            <button type="submit" class="submit-button" id="search-course-submit">Cerca</button>
        </form>
    </div>
</body>
</html><?php }
}
