<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Dettaglio Prenotazione</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to bottom right, #e3f2fd, #ffffff);
      padding: 2rem;
      margin: 0;
    }
    h1 {
      text-align: center;
      color: #0d47a1;
      margin-bottom: 2rem;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 2rem;
    }
    .field-label {
      font-weight: 600;
      color: #1976d2;
      margin-top: 1rem;
    }
    .field-value {
      margin-left: 0.5rem;
    }
    .buttons {
      margin-top: 2rem;
      display: flex;
      justify-content: space-between;
    }
    button, .back-link {
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      font-size: 1rem;
      text-decoration: none;
      text-align: center;
      user-select: none;
    }
    button {
      background-color: #d32f2f;
      color: white;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #9a2424;
    }
    .back-link {
      background-color: #1976d2;
      color: white;
      line-height: 1.8;
      display: inline-block;
      transition: background-color 0.3s ease;
    }
    .back-link:hover {
      background-color: #115293;
    }
  </style>
</head>
<body>

  <h1>Dettaglio Prenotazione</h1>
  
  <div class="container">
    <div>
      <span class="field-label">ID:</span>
      <span class="field-value">
        {if $reservation neq null}
          {$reservation->getId()}
        {else}
          [getId()]
        {/if}
      </span>
    </div>

    <div>
      <span class="field-label">Data:</span>
      <span class="field-value">
        {if $reservation neq null}
          {$reservation->getDate()|date_format:"%Y-%m-%d"}
        {else}
          [getDate()]
        {/if}
      </span>
    </div>

    <div>
      <span class="field-label">Orario:</span>
      <span class="field-value">
        {if $reservation neq null}
          {$reservation->getTime()}
        {else}
          [getTime()]
        {/if}
      </span>
    </div>

    <div>
      <span class="field-label">Campo:</span>
      <span class="field-value">
        {if $reservation neq null && $reservation->getField() neq null}
          {$reservation->getField()->getSport()}
        {else}
          [getField()->getSport()]
        {/if}
      </span>
    </div>

    <div>
      <span class="field-label">Cliente:</span>
      <span class="field-value">
        {if $reservation neq null && $reservation->getClient() neq null}
          {$reservation->getClient()->getName()} {$reservation->getClient()->getSurname()}
        {else}
          [getClient()->getName()] [getClient()->getSurname()]
        {/if}
      </span>
    </div>

    <div class="buttons">
      <form method="post" action="/employee/cancelReservation" onsubmit="return confirm('Sei sicuro di voler cancellare questa prenotazione?');">
        <input type="hidden" name="id" value="{if $reservation neq null}{$reservation->getId()}{/if}">
        <button type="submit">Cancella Prenotazione</button>
      </form>

      <a href="/employee/showReservations" class="back-link">Torna all'elenco</a>
    </div>
  </div>

</body>
</html>
