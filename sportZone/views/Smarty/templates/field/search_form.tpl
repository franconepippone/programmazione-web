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
    form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    label {
      display: block;
      margin-top: 10px;
      margin-bottom: 5px;
    }
    input[type="text"], input[type="date"] {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
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

  <h2>Inserisci Giorno e Sport</h2>

  <form action="/field/showResults" method="POST">
    <label for="giorno">Giorno:</label>
    <input type="date" id="giorno" name="giorno" required>

    <label for="sport">Sport:</label>
    <input type="text" id="sport" name="sport" placeholder="Es. Calcio, Tennis" required>

    <button type="submit">Invia</button>
  </form>

</body>
</html>
