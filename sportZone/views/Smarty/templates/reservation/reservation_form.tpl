<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Prenotazione Campo (Test)</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 2rem;
      color: #333;
    }
    .container {
      background-color: #fff;
      max-width: 600px;
      margin: 0 auto;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
    }
    .field {
      margin-bottom: 1rem;
    }
    .label {
      font-weight: bold;
    }
    .method-hint {
      color: #888;
      font-style: italic;
      font-size: 0.9em;
    }
    select, button {
      padding: 0.5rem;
      font-size: 1rem;
      width: 100%;
      margin-top: 0.5rem;
    }
    button {
      background-color: #2ecc71;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 1rem;
    }
    button:hover {
      background-color: #27ae60;
    }
    .image-box {
      text-align: center;
      margin-bottom: 2rem;
    }
    .image-box img {
      max-width: 100%;
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="image-box">
      <!-- Inserisci qui la tua immagine -->
      <img src="path/to/your/image.jpg" alt="Campo sportivo">
    </div>

    <h2>Prenotazione Campo (Modalità Test)</h2>

    <form method="POST" action="/reservation/finalizeReservation">

      <div class="field">
        <span class="label">Sport:</span><br>
        {if isset($field)}
          {$field->getSport()}
        {else}
          <span class="method-hint">\$field->getSport()</span>
        {/if}
      </div>

      <div class="field">
        <span class="label">Tipo terreno:</span><br>
        {if isset($field)}
          {$field->getTerrainType()}
        {else}
          <span class="method-hint">\$field->getTerrainType()</span>
        {/if}
      </div>

      <div class="field">
        <span class="label">Coperto:</span><br>
        {if isset($field)}
          {if $field->getIsIndoor()}Sì{else}No{/if}
        {else}
          <span class="method-hint">\$field->getIsIndoor() → true=Sì / false=No</span>
        {/if}
      </div>

      <div class="field">
        <span class="label">Costo orario:</span><br>
        {if isset($field)}
          €{$field->getCost()|number_format:2}
        {else}
          <span class="method-hint">\$field->getCost()</span>
        {/if}
      </div>

      <div class="field">
        <span class="label">Data:</span><br>
        {if isset($date)}
          {$date}
        {else}
          <span class="method-hint">\$date (passata via GET o da controller)</span>
        {/if}
      </div>

      <input type="hidden" name="field_id" value="{if isset($field)}{$field->getId()}{else}\$field->getId(){/if}" />
      <input type="hidden" name="date" value="{if isset($date)}{$date}{else}\$date{/if}" />

      <div class="field">
        <label for="time" class="label">Seleziona orario:</label><br>
        <select name="time" id="time" required>
          {if isset($availableHours)}
            {foreach $availableHours as $hour}
              <option value="{$hour}">{$hour}</option>
            {/foreach}
          {else}
            <option disabled selected>
              -- \$availableHours (es. da \$field->getAvailableHoursByDate(\$date)) --
            </option>
          {/if}
        </select>
      </div>

      <button type="submit">Conferma Orario</button>

    </form>
  </div>

</body>
</html>
