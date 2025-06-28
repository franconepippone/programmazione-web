<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Dettaglio Prenotazione</title>
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient" style="background: linear-gradient(to bottom right, #e3f2fd, #ffffff); padding: 2rem; margin: 0;">

  <h1 class="text-center text-primary mb-4">Dettaglio Prenotazione</h1>

  <div class="container bg-white rounded shadow-sm p-4" style="max-width: 600px;">

    <div class="mb-3">
      <span class="fw-semibold text-primary">ID:</span>
      <span class="ms-2">
        {if $reservation neq null}
          {$reservation->getId()}
        {else}
          [getId()]
        {/if}
      </span>
    </div>

    <div class="mb-3">
      <span class="fw-semibold text-primary">Data:</span>
      <span class="ms-2">
        {if $reservation neq null}
          {$reservation->getDate()|date_format:"%Y-%m-%d"}
        {else}
          [getDate()]
        {/if}
      </span>
    </div>

    <div class="mb-3">
      <span class="fw-semibold text-primary">Orario:</span>
      <span class="ms-2">
        {if $reservation neq null}
          {$reservation->getTime()}
        {else}
          [getTime()]
        {/if}
      </span>
    </div>

    <div class="mb-3">
      <span class="fw-semibold text-primary">Campo:</span>
      <span class="ms-2">
        {if $reservation neq null && $reservation->getField() neq null}
          {$reservation->getField()->getSport()}
        {else}
          [getField()->getSport()]
        {/if}
      </span>
    </div>

    <div class="mb-3">
      <span class="fw-semibold text-primary">Cliente:</span>
      <span class="ms-2">
        {if $reservation neq null && $reservation->getClient() neq null}
          {$reservation->getClient()->getName()} {$reservation->getClient()->getSurname()}
        {else}
          [getClient()->getName()] [getClient()->getSurname()]
        {/if}
      </span>
    </div>

    <div class="d-flex justify-content-between mt-4">
      <form method="post" action="/employee/cancelReservation" onsubmit="return confirm('Sei sicuro di voler cancellare questa prenotazione?');" class="m-0">
        <input type="hidden" name="id" value="{if $reservation neq null}{$reservation->getId()}{/if}" />
        <button type="submit" class="btn btn-danger fw-semibold px-4">Cancella Prenotazione</button>
      </form>

      <a href="/employee/showReservations" class="btn btn-primary fw-semibold px-4 align-self-center">Torna all'elenco</a>
    </div>
  </div>

</body>
</html>
