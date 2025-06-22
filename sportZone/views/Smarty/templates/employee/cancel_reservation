<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Annullamento Prenotazione - Employee</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #1976d2, #1565c0);
      color: #143e76;
      margin: 0;
      padding: 2rem 1rem;
      display: flex;
      justify-content: center;
      min-height: 100vh;
      align-items: center;
    }
    .container {
      background: #f1f8ff;
      max-width: 500px;
      width: 100%;
      border-radius: 18px;
      padding: 2.5rem 2rem;
      box-shadow: 0 15px 35px rgba(21, 69, 136, 0.3);
      text-align: center;
    }
    h2 {
      font-weight: 700;
      margin-bottom: 1rem;
      font-size: 2rem;
      color: #0d47a1;
      letter-spacing: 0.07em;
      text-transform: uppercase;
    }
    h3 {
      font-weight: 600;
      color: #0d47a1;
      margin-bottom: 1.2rem;
      border-bottom: 2px solid #0d47a1;
      padding-bottom: 0.4rem;
      letter-spacing: 0.05em;
    }
    p, ul {
      color: #1a237e;
      font-size: 1.05rem;
      margin-bottom: 1rem;
      text-align: left;
    }
    ul {
      list-style: none;
      padding: 0;
      background: #dbe9ff;
      border-radius: 12px;
      box-shadow: inset 0 0 10px #a5c8ff;
    }
    li {
      padding: 0.65rem 1rem;
      border-bottom: 1px solid #9fbfff;
    }
    li:last-child {
      border-bottom: none;
    }
    strong {
      color: #0d47a1;
      min-width: 140px;
      display: inline-block;
    }
    form {
      margin-top: 2rem;
    }
    button {
      background-color: #0d47a1;
      color: #fff;
      border: none;
      padding: 0.8rem 1.6rem;
      font-weight: 600;
      font-size: 1rem;
      border-radius: 14px;
      cursor: pointer;
      box-shadow: 0 6px 16px #083a8cbb;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #083a8c;
    }
    .error-message {
      color: #fff;
      background-color: #1565c0;
      padding: 1rem;
      border-radius: 12px;
      margin-bottom: 2rem;
      font-weight: 600;
      text-align: center;
      box-shadow: 0 0 10px #0d47a1bb;
    }
  </style>
</head>
<body>
  <section class="container">

    <h2>Annullamento Prenotazione (Employee)</h2>

    {if isset($errorMessage)}
      <div class="error-message">{$errorMessage}</div>
    {else}
      <h3>Riepilogo Prenotazione</h3>

      <p><strong>ID Prenotazione:</strong> 
        {if $reservation neq null}
          {$reservation->getId()|default:'[getId()]'}
        {else}
          [getId()]
        {/if}
      </p>

      <p><strong>Data:</strong> 
        {if $reservation neq null && $reservation->getDate() neq null}
          {$reservation->getDate()|date_format:"%Y-%m-%d"}
        {else}
          [getDate()]
        {/if}
      </p>

      <p><strong>Orario:</strong> 
        {if $reservation neq null}
          {$reservation->getTime()|default:'[getTime()]'}
        {else}
          [getTime()]
        {/if}
      </p>

      {assign var=campo value=$reservation neq null ? $reservation->getField() : null}

      <p><strong>Campo Sportivo:</strong></p>
      <ul>
        <li>Sport: 
          {if $campo neq null}
            {$campo->getSport()|default:'[getSport()]'}
          {else}
            [getSport()]
          {/if}
        </li>
        <li>Tipo terreno: 
          {if $campo neq null}
            {$campo->getTipoTerreno()|default:'[getTipoTerreno()]'}
          {else}
            [getTipoTerreno()]
          {/if}
        </li>
        <li>Indoor: 
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
        <li>Costo Orario: 
          {if $campo neq null}
            {$campo->getCostoOrario()|default:'[getCostoOrario()]'} €
          {else}
            [getCostoOrario()]
          {/if}
        </li>
      </ul>

      <form method="post" action="/employee/cancelReservation">
        <input type="hidden" name="id" value="{if $reservation neq null}{$reservation->getId()}{else}0{/if}">
        <button type="submit" name="confirm">Conferma annullamento</button>
      </form>
    {/if}

  </section>
</body>
</html>
