<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Dettagli Prenotazione</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f1f8ff;
      padding: 2rem;
      color: #0d47a1;
    }
    h1 {
      text-align: center;
      margin-bottom: 2rem;
    }
    .details {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .detail-row {
      margin-bottom: 1rem;
      display: flex;
      justify-content: space-between;
    }
    .label {
      font-weight: bold;
    }
    .actions {
      text-align: center;
      margin-top: 2rem;
    }
    .button {
      padding: 0.5rem 1.2rem;
      margin: 0 0.5rem;
      font-size: 1rem;
      background-color: #1565c0;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    .button:hover {
      background-color: #0d47a1;
    }
    .back-button {
      background-color: #90caf9;
      color: #0d47a1;
    }
    .back-button:hover {
      background-color: #64b5f6;
    }
  </style>
</head>
<body>

  <h1>Dettagli Prenotazione</h1>

  <div class="details">
    <div class="detail-row">
      <span class="label">ID Prenotazione:</span>
      <span>{$reservation->getId()|default:'[getId()]'}</span>
    </div>

    <div class="detail-row">
      <span class="label">Data:</span>
      <span>{$reservation->getDate()|date_format:"%Y-%m-%d"|default:'[getDate()]'}</span>
    </div>

    <div class="detail-row">
      <span class="label">Orario:</span>
      <span>{$reservation->getTime()|default:'[getTime()]'}</span>
    </div>

    <div class="detail-row">
      <span class="label">Campo:</span>
      <span>
        {if $reservation->getField() neq null}
          {$reservation->getField()->getSport()|default:'[getSport()]'}
        {else}
          [getField()->getSport()]
        {/if}
      </span>
    </div>

    <div class="detail-row">
      <span class="label">Cliente:</span>
      <span>
        {if $reservation->getClient() neq null}
          {$reservation->getClient()->getName()|default:'[getName()]'} {$reservation->getClient()->getSurname()|default:'[getSurname()]'}
        {else}
          [getClient()->getName()] [getClient()->getSurname()]
        {/if}
      </span>
    </div>

    <div class="actions">
      <form method="post" action="/employee/cancelReservation" style="display:inline;">
        <input type="hidden" name="id" value="{$reservation->getId()|default:'0'}">
        <button type="submit" class="button">Cancella Prenotazione</button>
      </form>

      <form method="post" action="/employee/showReservations" style="display:inline;">
        <button type="submit" class="button back-button">Torna all’elenco</button>
      </form>
    </div>
  </div>

</body>
</html>
