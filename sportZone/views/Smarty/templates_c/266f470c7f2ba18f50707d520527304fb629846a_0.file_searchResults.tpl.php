<?php
/* Smarty version 5.5.1, created on 2025-06-24 19:50:44
  from 'file:course/searchResults.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685ae574f15ee0_31184861',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '266f470c7f2ba18f50707d520527304fb629846a' => 
    array (
      0 => 'course/searchResults.tpl',
      1 => 1750787423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685ae574f15ee0_31184861 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazione-web\\sportZone\\views\\Smarty\\templates\\course';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati Ricerca</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/results.css">
    <!-- Per stili specifici di entità, aggiungi un altro CSS, es: -->
    <!-- <link rel="stylesheet" href="/sportZone/views/Smarty/css/course.css"> -->
</head>
<body>
    <div class="results-list">
        <h2>Risultati della Ricerca</h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('courses')) > 0) {?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('courses'), 'course');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('course')->value) {
$foreach0DoElse = false;
?>
                <div class="result-card">
                    <!-- id nascosto -->
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('course')['id'];?>
">
                    <div class="result-info">
                        <div class="result-title" name="title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('course')['title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                        <div class="result-date" name="startDate">
                            Inizio: <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('course')['startDate'],"%d/%m/%Y");?>

                        </div>
                    </div>
                    <a class="details-btn" href="/course/courseDetail/<?php echo $_smarty_tpl->getValue('course')['id'];?>
">Dettagli</a>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
            <p>Nessun risultato trovato con i filtri selezionati.</p>
        <?php }?>
    </div>
</body>
</html><?php }
}
