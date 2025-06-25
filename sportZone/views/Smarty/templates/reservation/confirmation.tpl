<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Prenotazione Confermata</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: #3c1361;
      margin: 0;
      padding: 2rem 1rem;
      display: flex;
      justify-content: center;
      min-height: 100vh;
      align-items: center;
    }
    .container {
      background: #fff;
      max-width: 460px;
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
      color: #5a3e85;
      letter-spacing: 0.07em;
      text-transform: uppercase;
    }
    p {
      font-size: 1.1rem;
      margin-bottom: 2rem;
      color: #4a3d6e;
    }
    h3 {
      font-weight: 600;
      color: #764ba2;
      margin-bottom: 1rem;
      border-bottom: 2px solid #764ba2;
      padding-bottom: 0.4rem;
      letter-spacing: 0.05em;
    }
    ul {
      list-style: none;
      padding: 0;
      margin: 0 0 2rem 0;
      background: #f9f8fd;
      border-radius: 12px;
      box-shadow: inset 0 0 10px #e2def9;
      text-align: left;
    }
    li {
      padding: 0.75rem 1rem;
      font-size: 1rem;
      border-bottom: 1px solid #ddd6f7;
      color: #5a3e85;
    }
    li:last-child {
      border-bottom: none;
    }
    li strong {
      color: #764ba2;
      min-width: 140px;
      display: inline-block;
    }
    a.back-link {
      display: inline-block;
      padding: 0.7rem 1.2rem;
      font-weight: 600;
      font-size: 1rem;
      color: #fff;
      background: #764ba2;
      border-radius: 14px;
      text-decoration: none;
      box-shadow: 0 6px 16px #5a367fbb;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    a.back-link:hover {
      background: #5a367f;
      box-shadow: 0 8px 20px #4a2a6bcc;
    }

    @media (max-width: 480px) {
      .container {
        padding: 2rem 1rem;
      }
      h2 {
        font-size: 1.6rem;
      }
      li {
        font-size: 0.95rem;
      }
      a.back-link {
        font-size: 0.95rem;
        padding: 0.6rem 1rem;
      }
    }
  </style>
</head>
<body>

  <section class="container">
    <h2>Prenotazione Confermata</h2>
    <p>La tua prenotazione è stata registrata con successo.</p>

    {if isset($reservation)}
      <h3>Dettagli Prenotazione</h3>
      <ul>
        <li><strong>Data:</strong> {$reservation->getDate()|default:'[data non disponibile]'}</li>
        <li><strong>Orario:</strong> {$reservation->getTime()|default:'[orario non disponibile]'}</li>
        <li><strong>Campo:</strong>
          {if $reservation->getField() != null}
            {$reservation->getField()->getSport()} - {$reservation->getField()->getTipoTerreno()}
          {else}
            [campo non disponibile]
          {/if}
        </li>
        <li><strong>Metodo di pagamento:</strong>
          {if $reservation->getPayment() != null}
            {$reservation->getPayment()->getType()}
          {else}
            [non specificato]
          {/if}
        </li>
      </ul>
    {/if}

    <a href="/user/home" class="back-link" title="Torna alla home">
      ← Torna al modulo di prenotazione
    </a>
  </section>

</body>
</html>
