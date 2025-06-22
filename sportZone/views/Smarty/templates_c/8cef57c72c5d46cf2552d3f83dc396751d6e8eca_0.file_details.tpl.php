<?php
/* Smarty version 5.5.1, created on 2025-06-21 20:25:33
  from 'file:field/details.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6856f91dc4b455_65281091',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cef57c72c5d46cf2552d3f83dc396751d6e8eca' => 
    array (
      0 => 'field/details.tpl',
      1 => 1750529543,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6856f91dc4b455_65281091 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\field';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Dettagli Campo - <?php echo $_smarty_tpl->getValue('campo')['titolo'];?>
</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef0f4;
      margin: 0;
      padding: 20px;
    }

    .main {
      max-width: 1000px;
      margin: 0 auto;
    }

    h1 {
      font-size: 2em;
      margin-bottom: 20px;
    }

    .gallery-slider {
      position: relative;
      width: 100%;
      overflow: hidden;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .slides {
      display: flex;
      transition: transform 1s ease-in-out;
      width: 100%;
    }

    .slide {
      min-width: 100%;
      box-sizing: border-box;
    }

    .slide img {
      width: 100%;
      height: auto;
      display: block;
    }

    .details {
      background-color: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }

    .details h2 {
      margin-top: 0;
      font-size: 1.5em;
    }

    .info {
      color: #555;
      font-size: 1em;
      line-height: 1.6em;
      margin-top: 10px;
    }

    .map-container {
      margin-bottom: 40px;
    }

    .map-container iframe {
      width: 100%;
      height: 400px;
      border: 0;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .button-container {
      text-align: center;
      margin-bottom: 60px;
    }

    .btn {
      display: inline-block;
      padding: 14px 28px;
      background-color: #007BFF;
      color: white;
      font-size: 1em;
      border: none;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="main">
  <h1><?php echo $_smarty_tpl->getValue('campo')['titolo'];?>
</h1>

  <div class="gallery-slider">
    <div class="slides" id="slides">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('campo')['immagini'], 'img');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('img')->value) {
$foreach0DoElse = false;
?>
        <div class="slide">
          <img src="<?php echo $_smarty_tpl->getValue('img');?>
" alt="Immagine del campo">
        </div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
  </div>

  <div class="details">
    <h2>Informazioni Generali</h2>
    <div class="info">
      <strong>Sport:</strong> <?php echo $_smarty_tpl->getValue('campo')['sport'];?>
<br>
      <strong>Orario:</strong> <?php echo $_smarty_tpl->getValue('campo')['orario'];?>
<br>
      <?php if ((true && (true && null !== ($_smarty_tpl->getValue('campo')['superficie'] ?? null)))) {?><strong>Superficie:</strong> <?php echo $_smarty_tpl->getValue('campo')['superficie'];?>
<br><?php }?>
      <?php if ((true && (true && null !== ($_smarty_tpl->getValue('campo')['illuminazione'] ?? null)))) {?><strong>Illuminazione:</strong> <?php echo $_smarty_tpl->getValue('campo')['illuminazione'];?>
<br><?php }?>
      <strong>Prezzo:</strong> <?php echo $_smarty_tpl->getValue('campo')['prezzo'];?>
<br><br>
      <strong>Descrizione:</strong><br>
      <?php echo $_smarty_tpl->getValue('campo')['descrizione'];?>

    </div>
  </div>

  <div class="map-container">
    <iframe
      width="600"
      height="450"
      style="border:0"
      loading="lazy"
      allowfullscreen
      referrerpolicy="no-referrer-when-downgrade"
      src="https://maps.google.com/maps?q=<?php echo $_smarty_tpl->getValue('campo')['latitude'];?>
,<?php echo $_smarty_tpl->getValue('campo')['longitude'];?>
&hl=it&z=15&output=embed">
    </iframe>
  </div>

  <div class="button-container">
    <a href="/prenotazione/continua/<?php echo $_smarty_tpl->getValue('campo')['id'];?>
" class="btn">Continua con la prenotazione</a>
  </div>
</div>


<?php echo '<script'; ?>
>
  const slides = document.getElementById('slides');
  let index = 0;

  function nextSlide() {
    index = (index + 1) % slides.children.length;
    slides.style.transform = `translateX(-${index * 100}%)`;
  }

  setInterval(nextSlide, 5000);
<?php echo '</script'; ?>
>


</body>
</html>
<?php }
}
