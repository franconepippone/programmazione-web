<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Annullamento Prenotazione - Employee</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-primary bg-gradient text-white" style="font-family: 'Inter', sans-serif;">

  <section class="bg-light rounded-4 shadow p-5 text-center w-100" style="max-width: 500px;">

    <h2 class="fw-bold text-uppercase text-primary mb-3">Annullamento Prenotazione (Employee)</h2>

    {if isset($errorMessage)}
      <div class="alert alert-danger fw-semibold mb-4">{$errorMessage}</div>
    {else}
      <h3 class="fw-semibold border-bottom border-primary pb-2 text-primary mb-4">Riepilogo Prenotazione</h3>

      <p class="text-dark text-start mb-2"><strong class="d-inline-block me-2 text-primary">ID Prenotazione:</strong>
        {if $reservation neq null}
          {$reservation->getId()|default:'[getId()]'}
        {else}
          [getId()]
        {/if}
      </p>

      <p class="text-dark text-start mb-2"><strong class="d-inline-block me-2 text-primary">Data:</strong>
        {if $reservation neq null && $reservation->getDate() neq null}
          {$reservation->getDate()|date_format:"%Y-%m-%d"}
        {else}
          [getDate()]
        {/if}
      </p>

      <p class="text-dark text-start mb-4"><strong class="d-inline-block me-2 text-primary">Orario:</strong>
        {if $reservation neq null}
          {$reservation->getTime()|default:'[getTime()]'}
        {else}
          [getTime()]
        {/if}
      </p>

      {assign var=campo value=$reservation neq null ? $reservation->getField() : null}

      <p class="fw-semibold text-start text-primary mb-2">Campo Sportivo:</p>
      <ul class="list-group mb-4">
        <li class="list-group-item">
          <strong class="me-2">Sport:</strong>
          {if $campo neq null}
            {$campo->getSport()|default:'[getSport()]'}
          {else}
            [getSport()]
          {/if}
        </li>
        <li class="list-group-item">
          <strong class="me-2">Tipo terreno:</strong>
          {if $campo neq null}
            {$campo->getTipoTerreno()|default:'[getTipoTerreno()]'}
          {else}
            [getTipoTerreno()]
          {/if}
        </li>
        <li class="list-group-item">
          <strong class="me-2">Indoor:</strong>
          {if $campo neq null}
            {if $campo->getIndoor() === null}
              [getIndoor()]
            {elseif $campo->getIndoor()}
              Indoor
            {else}
              Outdoor
            {/if}
          {else}
            [getIndoor()]
          {/if}
        </li>
        <li class="list-group-item">
          <strong class="me-2">Costo Orario:</strong>
          {if $campo neq null}
            {$campo->getCostoOrario()|default:'[getCostoOrario()]'} €
          {else}
            [getCostoOrario()]
          {/if}
        </li>
      </ul>

      <form method="post" action="/employee/cancelReservation" class="text-center">
        <input type="hidden" name="id" value="{if $reservation neq null}{$reservation->getId()}{else}0{/if}">
        <button type="submit" name="confirm" class="btn btn-primary fw-semibold px-4 py-2">
          Conferma annullamento
        </button>
      </form>
    {/if}

  </section>
</body>
</html>
