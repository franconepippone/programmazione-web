<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Dettagli Prenotazione</title>
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
      background-color: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .info {
      margin-bottom: 1.5rem;
    }
    .info p {
      margin: 0.5rem 0;
      font-size: 1.1rem;
    }
    .label {
      font-weight: 600;
      color: #1565c0;
    }
    form {
      text-align: center;
    }
    .btn-cancel, .btn-back {
      margin-top: 1rem;
      padding: 0.6rem 1.2rem;
      font-size: 1rem;
      border-radius: 6px;
      cursor: pointer;
      border: none;
      display: block;
      width: 100%;
      transition: background-color 0.3s ease;
    }
    .btn-cancel {
      background-color: #e53935;
      color: white;
    }
    .btn-cancel:hover {
      background-color: #c62828;
    }
    .btn-back {
      background-color: #90caf9;
      color: #0d47a1;
    }
    .btn-back:hover {
      background-color: #64b5f6;
    }
  </style>
</head>
<body>

  <h1>Dettagli Prenotazione</h1>

  <div class="container">
    <div class="info">
      <p><span class="label">ID Prenotazione:</span> {$reservation->getId()|default:'[getId()]'}</p>
      <p><span class="label">Data:</span> {$reservation->getDate()|date_format:"%Y-%m-%d"}</p>
      <p><span class="label">Orario:</span> {$reservation->getTime()|default:'[getTime()]'}</p>
      <p><span class="label">Campo:</span> {$reservation->getField()->getSport()|default:'[getSport()]'}</p>
      <p><span class="label">Cliente:</span>
        {if $reservation->getClient() neq null}
          {$reservation->getClient()->getName()} {$reservation->getClient()->getSurname()}
        {else}
          [getClient()->getName()] [getClient()->getSurname()]
        {/if}
      </p>
    </div>

    <form method="post" action="/employee/cancelReservation">
      <input type="hidden" name="id" value="{$reservation->getId()}">
      <button type="submit" class="btn-cancel">Cancella Prenotazione</button>
    </form>

    <a href="/employee/showReservations">
      <button type="button" class="btn-back">Torna all'elenco</button>
    </a>
  </div>

</body>
</html>
