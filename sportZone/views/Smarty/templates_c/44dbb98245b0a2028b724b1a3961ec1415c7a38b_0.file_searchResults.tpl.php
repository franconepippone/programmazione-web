<?php
/* Smarty version 5.5.1, created on 2025-06-23 14:07:03
  from 'file:course/searchResults.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68594367574487_46740328',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44dbb98245b0a2028b724b1a3961ec1415c7a38b' => 
    array (
      0 => 'course/searchResults.tpl',
      1 => 1750680289,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68594367574487_46740328 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\course';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Elenco Corsi</title>
    <link rel="stylesheet" href="stile_corsi.css">
</head>
<body>

    <h1 id="titolo-pagina">Elenco dei Corsi Disponibili</h1>

    <div id="corsi-container">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi'), 'corso');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('corso')->value) {
$foreach0DoElse = false;
?>
            <div class="corso-card">
                <img class="corso-immagine" src="<?php echo $_smarty_tpl->getValue('corso')['immagine'];?>
" alt="Immagine del corso: <?php echo $_smarty_tpl->getValue('corso')['nome'];?>
">
                <div class="corso-dettagli">
                    <h2 class="corso-nome"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('corso')['nome'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
                    <p class="corso-date">
                        Dal <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('corso')['data_inizio'],"%d/%m/%Y");?>
 al <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('corso')['data_fine'],"%d/%m/%Y");?>

                    </p>
                </div>
            </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>

</body>
</html>

<?php }
}
