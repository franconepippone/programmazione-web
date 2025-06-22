<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Prenotazione Cancellata</title>
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
      max-width: 460px;
      width: 100%;
      border-radius: 18px;
      padding: 2.5rem 2rem;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      text-align: center;
      animation: fadeIn 0.8s ease forwards;
    }
    h2 {
      font-weight: 700;
      margin-bottom: 1rem;
      font-size: 2rem;
      color: #b71c1c;
      letter-spacing: 0.07em;
      text-transform: uppercase;
    }
    p {
      font-size: 1.1rem;
      margin-bottom: 2rem;
      color: #a53939;
    }
    a.back-link {
      display: inline-block;
      padding: 0.7rem 1.2rem;
      font-weight: 600;
      font-size: 1rem;
      color: #fff;
      background: #b71c1c;
      border-radius: 14px;
      text-decoration: none;
      box-shadow: 0 6px 16px #8a1515bb;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    a.back-link:hover {
      background: #8a1515;
      box-shadow: 0 8px 20px #6b0f0fbb;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    @media (max-width: 480px) {
      .container {
        padding: 2rem 1rem;
      }
      h2 {
        font-size: 1.6rem;
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
    <h2>Prenotazione Cancellata</h2>
    <p>La tua prenotazione è stata cancellata con successo.</p>

    <a href="/reservation/reservationForm" class="back-link" title="Torna al modulo di prenotazione">
      ← Torna al modulo di prenotazione
    </a>
  </section>

</body>
</html>
