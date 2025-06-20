
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

  <form method="POST" action="/reservation/finalizeReservation">

    <div class="field-info">
      <div>
        <!-- Se non hai un'immagine, puoi usare un placeholder -->
        <img src="/images/placeholder_field.jpg" alt="Campo">
      </div>
      <div class="field-details">
        <p><strong>Sport:</strong> <?php echo htmlspecialchars($field->getSport()); ?></p>
        <p><strong>Tipo terreno:</strong> <?php echo htmlspecialchars($field->getTerrainType()); ?></p>
        <p><strong>Coperto:</strong> <?php echo $field->getIsIndoor() ? 'Sì' : 'No'; ?></p>
        <p><strong>Costo orario:</strong> €<?php echo number_format($field->getCost(), 2); ?></p>
        <p><strong>Data selezionata:</strong> <?php echo htmlspecialchars($date); ?></p>
      </div>
    </div>

    <input type="hidden" name="field_id" value="<?php echo $field->getId(); ?>">
    <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">

    <label for="time">Seleziona orario:</label>
    <select name="time" id="time" required>
      <?php for ($hour = 8; $hour <= 22; $hour++): ?>
        <option value="<?php echo $hour; ?>:00"><?php echo $hour; ?>:00</option>
      <?php endfor; ?>
    </select>

    <label for="payment_method">Metodo di pagamento:</label>
    <select name="payment_method" id="payment_method" required>
      <option value="online">Pagamento Online</option>
      <option value="onsite">Pagamento in sede</option>
    </select>

    <button type="submit">Conferma Prenotazione</button>
  </form>

</body>
</html>
