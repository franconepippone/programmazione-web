<?php
/* Smarty version 5.5.1, created on 2025-06-21 20:19:40
  from 'file:field/search_results_list.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6856f7bcaa4e38_64943152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf256efcc63c42276532847057245a8799abe844' => 
    array (
      0 => 'field/search_results_list.tpl',
      1 => 1750529541,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6856f7bcaa4e38_64943152 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\field';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Campi Sportivi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef0f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      cursor: pointer;
      text-decoration: none;
      color: inherit;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
    }

    .card-title {
      font-size: 1.2em;
      margin-bottom: 8px;
    }

    .card-details {
      font-size: 0.9em;
      color: #555;
    }

    .price {
      margin-top: 10px;
      font-weight: bold;
      color: #007BFF;
    }
  </style>
</head>
<body>

  <h1>Seleziona un Campo Sportivo</h1>

  <div class="container">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('fields'), 'field');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('field')->value) {
$foreach0DoElse = false;
?>
      <a class="card" href="/field/details/<?php echo $_smarty_tpl->getValue('field')['id'];?>
">
        <img src="<?php echo $_smarty_tpl->getValue('field')['image'];?>
" alt="<?php echo $_smarty_tpl->getValue('field')['alt'];?>
">
        <div class="card-body">
          <div class="card-title"><?php echo $_smarty_tpl->getValue('field')['title'];?>
</div>
          <div class="card-details">
            Sport: <?php echo $_smarty_tpl->getValue('field')['sport'];?>
<br>
            Orario: <?php echo $_smarty_tpl->getValue('field')['orario'];?>
<br>
            <?php if ((true && (true && null !== ($_smarty_tpl->getValue('field')['superficie'] ?? null)))) {?>Superficie: <?php echo $_smarty_tpl->getValue('field')['superficie'];?>
<br><?php }?>
            <?php if ((true && (true && null !== ($_smarty_tpl->getValue('field')['illuminazione'] ?? null)))) {?>Illuminazione: <?php echo $_smarty_tpl->getValue('field')['illuminazione'];?>
<br><?php }?>
          </div>
          <div class="price"><?php echo $_smarty_tpl->getValue('field')['price'];?>
</div>
        </div>
      </a>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </div>

</body>
</html>
<?php }
}
