{extends file=$layout} 
{assign var="page_title" value="Dettagli Campo Sportivo"}

{block name="styles"}
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="content"}
  <div class="container my-5">
    <h1 class="mb-4">{$field.name}</h1>

    <div class="mb-4 rounded overflow-hidden shadow">
      <div class="d-flex" id="slides">
        {foreach $field.images as $img}
          <div class="w-100">
            <img src="{$img}" alt="Immagine del campo" class="img-fluid w-100" style="height: 340px; object-fit: cover;">
          </div>
        {/foreach}
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <div class="p-4 bg-light rounded shadow">
          <h2 class="h5 text-primary mb-3">Informazioni Generali</h2>
          <div>
            <p class="mb-1"><strong>Sport:</strong> {$field.sport}</p>
            <p class="mb-1"><strong>Orario:</strong> 8:00 - 21:00</p>
            {if isset($field.terrainType)}<p class="mb-1"><strong>Superficie:</strong> {$field.terrainType}</p>{/if}
            {if isset($field.illuminazione)}<p class="mb-1"><strong>Illuminazione:</strong> {$field.illuminazione}</p>{/if}
            <p class="mb-3"><strong>Prezzo:</strong> {$field.hourlyCost}</p>
            <p><strong>Descrizione:</strong><br>{$field.description}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="rounded overflow-hidden shadow">
          <iframe
            class="w-100"
            height="320"
            style="border:0;"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://maps.google.com/maps?q={$field.latitude},{$field.longitude}&hl=it&z=15&output=embed">
          </iframe>
        </div>
      </div>
    </div>

    <div class="text-center my-4">
      <a href="/reservation/reservationForm?{$queryString}" class="btn btn-primary px-4 py-2">Continua con la prenotazione</a>
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
  </div>
{/block}
