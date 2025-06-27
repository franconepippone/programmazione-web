<?php
/* Smarty version 5.5.1, created on 2025-06-26 21:52:18
  from 'file:course/searchForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685da4f28619d5_55136196',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc4039a8f6c13763989198a0273bd278a0d5a9ac' => 
    array (
      0 => 'course/searchForm.tpl',
      1 => 1750967536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685da4f28619d5_55136196 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazione-web\\sportZone\\views\\Smarty\\templates\\course';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Corsi</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
    <div class="form-wrapper">
        <h2>Ricerca Corsi</h2>
        <form method="get" action="/course/showCourses">
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" id="title" name="title" placeholder="Titolo corso">
            </div>
            <div class="form-group">
                <label for="startDate">Data inizio</label>
                <input type="date" id="startDate" name="startDate">
            </div>
            <div class="form-group">
                <label>Giorni della settimana</label>
                <?php $_smarty_tpl->assign('weekdays', array("Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"), false, NULL);?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('weekdays'), 'day');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('day')->value) {
$foreach0DoElse = false;
?>
                    <label style="margin-right:1em;">
                        <input type="checkbox" name="daysOfWeek[]" value="<?php echo $_smarty_tpl->getValue('day');?>
">
                        <?php echo $_smarty_tpl->getValue('day');?>

                    </label>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
            <button type="submit" class="submit-button">Cerca</button>
        </form>
    </div>
</body>
</html><?php }
}
