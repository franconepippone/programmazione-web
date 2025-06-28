<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Cancellazione Prenotazione</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f44336, #e53935);
      color: #7f1d1d;
      margin: 0;
      padding: 2rem 1rem;
      display: flex;
      justify-content: center;
      min-height: 100vh;
      align-items: center;
    }
    .container {
      background: #fff;
      max-width: 480px;
      width: 100%;
      border-radius: 18px;
      padding: 2.5rem 2rem;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      text-align: center;
    }
    h2 {
      font-weight: 700;
      margin-bottom: 1rem;
      font-size: 2rem;
      color: #b71c1c;
      letter-spacing: 0.07em;
      text-transform: uppercase;
    }
    h3 {
      font-weight: 600;
      color: #b71c1c;
      margin-bottom: 1.2rem;
      border-bottom: 2px solid #b71c1c;
      padding-bottom: 0.4rem;
      letter-spacing: 0.05em;
    }
    p, ul {
      color: #a53939;
      font-size: 1.05rem;
      margin-bottom: 1rem;
      text-align: left;
    }
    ul {
      list-style: none;
      padding: 0;
      background: #feecec;
      border-radius: 12px;
      box-shadow: inset 0 0 10px #f5c5c5;
    }
    li {
      padding: 0.65rem 1rem;
      border-bottom: 1px solid #f2a1a1;
    }
    li:last-child {
      border-bottom: none;
    }
    strong {
      color: #b71c1c;
      min-width: 140px;
      display: inline-block;
    }
    form {
      margin-top: 2rem;
    }
    button {
      background-color: #b71c1c;
      color: #fff;
      border: none;
      padding: 0.8rem 1.6rem;
      font-weight: 600;
      font-size: 1rem;
      border-radius: 14px;
      cursor: pointer;
      box-shadow: 0 6px 16px #8a1515bb;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #8a1515;
    }
    .error-message {
      color: #fff;
      background-color: #d32f2f;
      padding: 1rem;
      border-radius: 12px;
      margin-bottom: 2rem;
      font-weight: 600;
      text-align: center;
      box-shadow: 0 0 10px #b71c1cbb;
    }
  </style>
</head>
<body>
  <section class="container">

    <h2>Cancellazione Prenotazione</h2>

    {if isset($errorMessage)}
      <div class="error-message">{$errorMessage}</div>
    {else}
      <h3>Riepilogo Prenotazione</h3>

      <p><strong>ID Prenotazione:</strong> {$reservation.id|default:'-'}</p>
      <p><strong>Data:</strong> {$reservation.date|date_format:"%Y-%m-%d"|default:'-'}</p>
      <p><strong>Orario:</strong> {$reservation.time|default:'-'}</p>

      <p><strong>Campo Sportivo:</strong></p>
      <ul>
        <li><strong>Sport:</strong> {$reservation.sport|default:'-'}</li>
        <li><strong>Tipo terreno:</strong> {$reservation.field|default:'-'}</li>
        <li><strong>Indoor:</strong> 
          {if isset($reservation.field_indoor)}
            {if $reservation.field_indoor}Sì{else}No{/if}
          {else}
            -
          {/if}
        </li>
        <li><strong>Costo Orario:</strong> 
          {if isset($reservation.hourlyCost)}€{$reservation.hourlyCost|number_format:2}{else}-{/if}
        </li>
        <li><strong>Metodo di Pagamento:</strong> {$reservation.paymentMethod|capitalize|default:'-'}</li>
      </ul>

      <form method="post" action="/reservation/finalizeCancelReservation">
        <input type="hidden" name="id" value="{$reservation.id|default:0}">
        <button type="submit" name="confirm">Conferma cancellazione</button>
      </form>
    {/if}

  </section>
</body>
</html>
