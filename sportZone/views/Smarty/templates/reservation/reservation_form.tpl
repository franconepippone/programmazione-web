{* prenotazione_campo.tpl *}

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
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
    select, input[type="hidden"] {
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
      width: 100%;
      font-size: 16px;
    }
    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <h2 style="text-align:center;">Prenotazione Campo</h2>

  <form method="GET" action="/reservation/finalizeReservation">

    <div class="field-info">
      <div>
        <img src="/images/placeholder_field.jpg" alt="Campo" />
      </div>
      <div class="field-details">
        <p><strong>Sport:</strong> {$field->getSport()|escape}</p>
        <p><strong>Tipo terreno:</strong> {$field->getTerrainType()|escape}</p>
        <p><strong>Coperto:</strong> {if $field->getIsIndoor()}Sì{else}No{/if}</p>
        <p><strong>Costo orario:</strong> €{$field->getCost()|number_format:2}</p>
        <p><strong>Data selezionata:</strong> {$date|escape}</p>
      </div>
    </div>

    <input type="hidden" name="field_id" value="{$field->getId()|escape}" />
    <input type="hidden" name="date" value="{$date|escape}" />

    <label for="time">Seleziona orario:</label>
    <select name="time" id="time" required>
      {foreach from=$availableHours item=hour}
        <option value="{$hour|escape}">{$hour|escape}</option>
      {/foreach}
    </select>

    <button type="submit">Conferma Orario</button>
  </form>

</body>
</html>
