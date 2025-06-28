{extends file=$layout} 
{assign var="page_title" value="Dettagli Campo Sportivo"}

{block name="styles"}
{/block}

{block name="content"}
  <div class="container my-3">

    <!-- Page Title with Sport Icon -->
    <h1 class="mb-4 text-center">
      <i class="bi bi-soccer" aria-hidden="true"></i>Campo {$field.name|default:'Campo Sportivo'|escape}
    </h1>

    <div class="row">
      <!-- Main info & tabs -->
      <div class="col-lg-8">
        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3" id="fieldTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
              Info
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="false">
              Immagini
            </button>
          </li>
        </ul>

        <div class="tab-content" id="fieldTabsContent">
          <!-- Info Tab -->
          <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            {if isset($field.images) && $field.images|@count > 0}
              <div class="mb-4 text-center">
                <img src="{$field.images[0]|escape}" alt="Immagine del campo" class="img-fluid rounded shadow-sm" style="max-height: 250px; width: 100%; object-fit: cover;">
              </div>

            {/if}


            <h3>{$field.name|escape}</h3>
            {if $field.description}
              <p>{$field.description|escape}</p>
            {/if}

            <ul class="list-group list-group-flush mb-3">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Costo Orario:</strong>
                <span>€ {$field.hourlyCost|escape}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Sport:</strong>
                <span>{$field.sport|escape}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Tipo Terreno:</strong>
                <span>{$field.terrainType|escape}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Al chiuso:</strong>
                <span>{if $field.isIndoor}Sì{else}No{/if}</span>
              </li>
            </ul>
          </div>



          <!-- Images Tab -->
        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
          {if isset($field.images) && $field.images|@count > 0}
            <div id="fieldCarousel" class="carousel slide mb-4 shadow rounded overflow-hidden" data-bs-ride="carousel">
              <div class="carousel-inner">
                {foreach from=$field.images item=img name=slideLoop}
                  <div class="carousel-item {if $smarty.foreach.slideLoop.first}active{/if}">
                    <img src="{$img|escape}" alt="Immagine del campo" class="d-block w-100" style="height: 500px; object-fit: cover;">
                  </div>
                {/foreach}
              </div>

              {if $field.images|@count > 1}
              <button class="carousel-control-prev" type="button" data-bs-target="#fieldCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Precedente</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#fieldCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Successivo</span>
              </button>
              {/if}
            </div>
          {else}
            {if $field.imageUrl|default:''}
            <div class="mb-4">
              <img src="{$field.imageUrl|escape}" alt="{$field.name|escape}" class="img-fluid rounded shadow-sm mb-3" style="max-height: 500px; object-fit: cover; width: 100%;">
            </div>
            {/if}
          {/if}
        </div>

        </div>
      </div>

      <!-- Reservation Summary Sidebar -->
      <div class="col-lg-4">
        <div class="position-sticky" style="top: 80px;">

          <!-- Booking Form Card -->
          <div class="card mb-5">
            <div class="card-body">
              <h5 class="card-title mb-3">Prenota il campo</h5>
              <p class="mb-2"><strong>Prezzo:</strong> {$field.hourlyCost|default:'N/A'} €/ora</p>
              {if isset($selectedDate)}
                <p class="mb-3"><strong>Data selezionata:</strong> {$selectedDate|date_format:"%d/%m/%Y"}</p>
              {/if}

              <form action="/reservation/reservationForm" method="GET">
                <input type="hidden" name="fieldId" value="{$field.id|escape}">
                <div class="mb-3">
                  <label for="reservationDate" class="form-label">Seleziona Data</label>
                  <input type="date" id="reservationDate" name="date" class="form-control" value="{$choosenDate|default:''}" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Prenota Ora</button>
              </form>
            </div>
          </div>

          <!-- Map Card -->
          <div class="card shadow-sm">
            <div class="ratio ratio-16x9">
              <iframe
                src="https://maps.google.com/maps?q={$field.latitude|escape},{$field.longitude|escape}&hl=it&z=15&output=embed"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                style="border:0;">
              </iframe>
            </div>
            <div class="card-footer text-center">
              <a 
                href="https://maps.google.com/?q={$field.latitude|escape},{$field.longitude|escape}" 
                target="_blank" 
                rel="noopener noreferrer"
                class="btn btn-outline-primary"
              >
                Apri in Google Maps
              </a>
            </div>
          </div>

        </div>
      </div>




    </div>
  </div>

{literal}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  });
</script>
{/literal}
{/block}




{block name="conten____"}
  <div class="container my-5">
    <h1 class="mb-4 text-center">{$field.name|default:'Campo Sportivo'|escape}</h1>

    {if isset($field.images) && $field.images|@count > 0}
    <div id="fieldCarousel" class="carousel slide mb-4 shadow rounded overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
        {foreach from=$field.images item=img name=slideLoop}
          <div class="carousel-item {if $smarty.foreach.slideLoop.first}active{/if}">
            <img src="{$img|escape}" alt="Immagine del campo" class="d-block w-100" style="height: 340px; object-fit: cover;">
          </div>
        {/foreach}
      </div>
      {if $field.images|@count > 1}
        <button class="carousel-control-prev" type="button" data-bs-target="#fieldCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Precedente</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#fieldCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Successivo</span>
        </button>
      {/if}
    </div>
    {/if}

    <div class="row g-4 mb-5">
      <div class="col-md-6">
        <div class="bg-light p-4 rounded shadow-sm h-100">
          <h2 class="h5 text-primary mb-3">Informazioni Generali</h2>
          <p class="mb-2"><strong>Sport:</strong> {$field.sport|default:'Non specificato'|escape}</p>
          <p class="mb-2"><strong>Orario:</strong> {$field.openingHours|default:'8:00 - 21:00'|escape}</p>
          {if isset($field.terrainType)}
            <p class="mb-2"><strong>Superficie:</strong> {$field.terrainType|escape}</p>
          {/if}
          {if isset($field.illuminazione)}
            <p class="mb-2"><strong>Illuminazione:</strong> {$field.illuminazione|escape}</p>
          {/if}
          <p class="mb-2"><strong>Prezzo:</strong> {$field.hourlyCost|default:'N/A'|escape} €/ora</p>
          {if isset($field.description)}
            <p class="mt-3"><strong>Descrizione:</strong><br>{$field.description|escape}</p>
          {/if}
        </div>
      </div>

      <div class="col-md-6">
        <div class="rounded shadow-sm overflow-hidden h-100">
          {if isset($field.latitude) && isset($field.longitude)}
            <iframe
              class="w-100"
              height="100%"
              style="min-height: 320px; border: 0;"
              loading="lazy"
              allowfullscreen
              referrerpolicy="no-referrer-when-downgrade"
              src="https://maps.google.com/maps?q={$field.latitude|escape},{$field.longitude|escape}&hl=it&z=15&output=embed">
            </iframe>
          {else}
            <div class="d-flex justify-content-center align-items-center" style="min-height: 320px; background-color: #f8f9fa;">
              <span class="text-muted">Mappa non disponibile</span>
            </div>
          {/if}
        </div>
      </div>
    </div>

    <div class="text-center">
      <a href="/reservation/reservationForm?{$queryString|default:''}" class="btn btn-lg btn-primary px-4">Continua con la prenotazione</a>
    </div>
  </div>
{/block}
