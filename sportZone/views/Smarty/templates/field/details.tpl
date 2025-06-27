{extends file=$layout}
{assign var="page_title" value="Dettagli Campo Sportivo"}

{block name="styles"}
  <style>
    .main {
      max-width: 1300px;   /* Increase this value as needed */
      width: 100%;
      margin: 0 auto;
      padding: 0 2rem 2rem 2rem; /* More horizontal padding for large screens */
      box-sizing: border-box;
    }

    h1 {
      font-size: 2em;
      margin-bottom: 24px;
      color: #1f2937;
      font-weight: 700;
      letter-spacing: -1px;
    }

    .gallery-slider {
      position: relative;
      width: 100%;
      overflow: hidden;
      border-radius: 14px;
      margin-bottom: 32px;
      box-shadow: 0 4px 16px rgba(31,41,55,0.10);
      background: #e5e7eb;
    }

    .slides {
      display: flex;
      transition: transform 1s cubic-bezier(.4,0,.2,1);
      width: 100%;
    }

    .slide {
      min-width: 100%;
      box-sizing: border-box;
    }

    .slide img {
      width: 100%;
      height: 340px;
      object-fit: cover;
      display: block;
      background: #e5e7eb;
      border-radius: 14px 14px 0 0;
    }

    .bottom-container {
      display: flex;
      gap: 2rem;
      width: 100%;
      margin-bottom: 32px;
      flex-wrap: wrap;
    }

    .details, .map-container {
      flex: 1 1 0;
      min-width: 320px;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(31,41,55,0.08);
      padding: 28px 24px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .details {
      margin-bottom: 0;
    }

    .details h2 {
      margin-top: 0;
      font-size: 1.3em;
      color: #2563eb;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .info {
      color: #374151;
      font-size: 1em;
      line-height: 1.7em;
      margin-top: 8px;
    }

    .map-container {
      align-items: center;
      justify-content: center;
      padding: 0;
      overflow: hidden;
    }

    .map-container iframe {
      width: 100%;
      height: 320px;
      border: 0;
      border-radius: 14px;
      box-shadow: none;
      display: block;
    }

    .button-container {
      text-align: center;
      margin-bottom: 30px;
      margin-top: 30px;
    }

    .btn {
      display: inline-block;
      padding: 14px 32px;
      background-color: #2563eb;
      color: #fff;
      font-size: 1.1em;
      border: none;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      box-shadow: 0 2px 8px rgba(31,41,55,0.08);
      transition: background 0.2s;
    }

    .btn:hover {
      background-color: #1e40af;
    }

    @media (max-width: 900px) {
      .main {
        padding: 0 0.5rem 2rem 0.5rem;
      }
      .bottom-container {
        flex-direction: column;
        gap: 1.2rem;
      }
      .details, .map-container {
        min-width: 0;
        padding: 18px 10px;
      }
      .map-container iframe {
        height: 220px;
      }
    }
  </style>
{/block}

{block name="content"}
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

    <div class="bottom-container">
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
    </div>

    <div class="button-container">
      <a href="/reservation/reservationForm?{$queryString}" class="btn">Continua con la prenotazione</a>
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
{/block}