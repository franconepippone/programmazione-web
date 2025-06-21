<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Prenotazione Campo</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f5f5f5;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    label {
      display: block;
      margin-top: 10px;
      margin-bottom: 5px;
    }
    select, input[type="text"], input[type="hidden"] {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }
    .field-info {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }
    .field-info img {
      width: 200px;
      height: auto;
      border-radius: 8px;
    }
    .field-details p {
      margin: 5px 0;
    }
    button {
      margin-top: 15px;
      padding: 10px 15px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <h2>Prenotazione Campo</h2>

  <form method="GET" action="/reservation/finalizeReservation">
    <div class="field-info">
      <div>
        <img src="/images/placeholder_field.jpg" alt="Campo">
      </div>
      <div class="field-details">
        <p><strong>Sport:</strong> Calcio</p>
        <p><strong>Tipo terreno:</strong> Erba sintetica</p>
        <p><strong>Coperto:</strong> Sì</p>
        <p><strong>Costo orario:</strong> €25.00</p>
        <p><strong>Data selezionata:</strong> 2025-06-21</p>
      </div>
    </div>

    <input type="hidden" name="field_id" value="123">
    <input type="hidden" name="date" value="2025-06-21">

    <label for="time">Seleziona orario:</label>
    <select name="time" id="time" required>
      <option value="10:00">10:00</option>
      <option value="11:00">11:00</option>
      <option value="12:00">12:00</option>
      <option value="13:00">13:00</option>
      <option value="14:00">14:00</option>
    </select>

    <button type="submit">Conferma Orario</button>
  </form>

</body>
</html>
