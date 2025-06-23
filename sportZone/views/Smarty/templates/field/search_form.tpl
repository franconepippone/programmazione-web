<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Modulo Giorno e Sport</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f5f5f5;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    form {
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      max-width: 400px;
      margin: 0 auto;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: bold;
      margin-bottom: 6px;
      color: #333;
    }

    input[type="date"],
    select {
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
      box-sizing: border-box;
    }

    button {
      padding: 12px;
      background-color: #007BFF;
      color: white;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <h2>Inserisci Giorno e Sport</h2>

  <form action="/field/showResults" method="GET">
    <div class="form-group">
      <label for="date">Giorno:</label>
      <input type="date" id="date" name="date">
    </div>

    <div class="form-group">
      <label for="sport">Seleziona uno sport:</label>
      <select name="sport" id="sport">
        <option value="">-- Tutti gli sport --</option>
        <option value="calcio">Calcio</option>
        <option value="tennis" selected>Tennis</option>
        <option value="basket">Basket</option>
        <option value="padel">Padel</option>
      </select>
    </div>

    <button type="submit">Invia</button>
  </form>

</body>
</html>
