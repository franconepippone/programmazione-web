<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Dettagli Campo - {$campo.titolo}</title>
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
  <h1>{$campo.titolo}</h1>

  <div class="gallery-slider">
    <div class="slides" id="slides">
      {foreach $campo.immagini as $img}
        <div class="slide">
          <img src="{$img}" alt="Immagine del campo">
        </div>
      {/foreach}
    </div>
  </div>

  <div class="details">
    <h2>Informazioni Generali</h2>
    <div class="info">
      <strong>Sport:</strong> {$campo.sport}<br>
      <strong>Orario:</strong> {$campo.orario}<br>
      {if isset($campo.superficie)}<strong>Superficie:</strong> {$campo.superficie}<br>{/if}
      {if isset($campo.illuminazione)}<strong>Illuminazione:</strong> {$campo.illuminazione}<br>{/if}
      <strong>Prezzo:</strong> {$campo.prezzo}<br><br>
      <strong>Descrizione:</strong><br>
      {$campo.descrizione}
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
      src="https://maps.google.com/maps?q={$campo.latitude},{$campo.longitude}&hl=it&z=15&output=embed">
    </iframe>
  </div>

  <div class="button-container">
    <a href="/prenotazione/continua/{$campo.id}" class="btn">Continua con la prenotazione</a>
  </div>
</div>

{literal}
<script>
  const slides = document.getElementById('slides');
  let index = 0;

  function nextSlide() {
    index = (index + 1) % slides.children.length;
    slides.style.transform = `translateX(-${index * 100}%)`;
  }

  setInterval(nextSlide, 5000);
</script>
{/literal}

</body>
</html>
