<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Campi Sportivi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef0f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      cursor: pointer;
      text-decoration: none;
      color: inherit;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
    }

    .card-title {
      font-size: 1.2em;
      margin-bottom: 8px;
    }

    .card-details {
      font-size: 0.9em;
      color: #555;
    }

    .price {
      margin-top: 10px;
      font-weight: bold;
      color: #007BFF;
    }
  </style>
</head>
<body>

  <h1>Seleziona un Campo Sportivo</h1>

  <div class="container">
    <a class="card" href="/field/details/campo_calcio_11">
      <img src="https://via.placeholder.com/400x180?text=Campo+Calcio" alt="Campo Calcio 11">
      <div class="card-body">
        <div class="card-title">Campo Calcio 11</div>
        <div class="card-details">Sport: Calcio<br>Orario: 09:00 - 22:00<br>Superficie: Erba sintetica</div>
        <div class="price">€60 / ora</div>
      </div>
    </a>

    <a class="card" href="/field/details/campo_tennis_coperto">
      <img src="https://via.placeholder.com/400x180?text=Campo+Tennis" alt="Campo Tennis Coperto">
      <div class="card-body">
        <div class="card-title">Campo Tennis Coperto</div>
        <div class="card-details">Sport: Tennis<br>Orario: 08:00 - 21:00<br>Superficie: Resina</div>
        <div class="price">€25 / ora</div>
      </div>
    </a>

    <a class="card" href="campo3.html">
      <img src="https://via.placeholder.com/400x180?text=Campo+Padel" alt="Campo Padel Deluxe">
      <div class="card-body">
        <div class="card-title">Campo Padel Deluxe</div>
        <div class="card-details">Sport: Padel<br>Orario: 10:00 - 23:00<br>Illuminazione: LED</div>
        <div class="price">€40 / ora</div>
      </div>
    </a>

    <a class="card" href="campo4.html">
      <img src="https://via.placeholder.com/400x180?text=Campo+Basket" alt="Campo Basket All'aperto">
      <div class="card-body">
        <div class="card-title">Campo Basket All'aperto</div>
        <div class="card-details">Sport: Basket<br>Orario: 07:00 - 20:00<br>Superficie: Cemento</div>
        <div class="price">€20 / ora</div>
      </div>
    </a>

    <a class="card" href="campo5.html">
      <img src="https://via.placeholder.com/400x180?text=Campo+Volley" alt="Campo Volley Beach">
      <div class="card-body">
        <div class="card-title">Campo Volley Beach</div>
        <div class="card-details">Sport: Beach Volley<br>Orario: 10:00 - 19:00<br>Superficie: Sabbia</div>
        <div class="price">€30 / ora</div>
      </div>
    </a>
  </div>

</body>
</html>
