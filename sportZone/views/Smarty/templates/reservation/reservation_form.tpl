<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Prenotazione Campo (Test)</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    /* Reset base */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: linear-gradient(135deg, #6dd5fa, #2980b9);
      margin: 0;
      padding: 2rem 1rem;
      display: flex;
      justify-content: center;
      min-height: 100vh;
      color: #2c3e50;
    }
    .container {
      background: #fff;
      max-width: 600px;
      width: 100%;
      border-radius: 16px;
      padding: 2.5rem 3rem;
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
      text-align: center;
    }
    .image-box {
      margin-bottom: 2rem;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .image-box img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
      transition: transform 0.3s ease;
      cursor: pointer;
      border-radius: 14px;
    }
    .image-box img:hover {
      transform: scale(1.05);
    }
    h2 {
      font-weight: 700;
      font-size: 2.4rem;
      margin-bottom: 2rem;
      color: #1b3a57;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }
    .field {
      margin-bottom: 1.5rem;
      text-align: left;
    }
    .label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.4rem;
      font-size: 1.1rem;
      color: #34495e;
    }
    .method-hint {
      font-style: italic;
      font-size: 0.9rem;
      color: #7f8c8d;
      user-select: text;
    }
    select, button {
      width: 100%;
      padding: 0.65rem 1rem;
      font-size: 1.1rem;
      border-radius: 8px;
      border: 2px solid #2980b9;
      outline-offset: 2px;
      transition: all 0.3s ease;
      font-weight: 500;
      cursor: pointer;
      color: #2c3e50;
      background: #ecf0f1;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg width='14' height='14' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 6l3 3 3-3' stroke='%232c3e50' stroke-width='2' fill='none' fill-rule='evenodd'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 12px;
    }
    select:focus {
      border-color: #1f618d;
      background: #d6eaf8;
    }
    button {
      background: #2980b9;
      border: none;
      color: white;
      font-weight: 700;
      letter-spacing: 0.05em;
      margin-top: 1.5rem;
      box-shadow: 0 6px 14px rgba(41,128,185,0.4);
      user-select: none;
      transition: background-color 0.25s ease;
    }
    button:hover {
      background: #1f618d;
      box-shadow: 0 8px 18px rgba(31,97,141,0.6);
    }
    button:active {
      transform: scale(0.98);
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="image-box">
      <!-- Inserisci qui la tua immagine -->
      <img src="path/to/your/image.jpg" alt="Campo sportivo" />
    </div>

    <h2>Prenotazione Campo (Modalità Test)</h2>

    <form method="POST" action="/reservation/finalizeReservation" novalidate>

      <div class="field">
        <label class="label">Sport:</label>
        {if isset($field)}
          <div>{$field->getSport()}</div>
        {else}
          <div class="method-hint">\$field->getSport()</div>
        {/if}
      </div>

      <div class="field">
        <label class="label">Tipo terreno:</label>
        {if isset($field)}
          <div>{$field->getTerrainType()}</div>
        {else}
          <div class="method-hint">\$field->getTerrainType()</div>
        {/if}
      </div>

      <div class="field">
        <label class="label">Coperto:</label>
        {if isset($field)}
          <div>{if $field->getIsIndoor()}Sì{else}No{/if}</div>
        {else}
          <div class="method-hint">\$field->getIsIndoor() → true = Sì / false = No</div>
        {/if}
      </div>

      <div class="field">
        <label class="label">Costo orario:</label>
        {if isset($field)}
          <div>€{$field->getCost()|number_format:2}</div>
        {else}
          <div class="method-hint">\$field->getCost()</div>
        {/if}
      </div>

      <div class="field">
        <label class="label">Data:</label>
        {if isset($date)}
          <div>{$date}</div>
        {else}
          <div class="method-hint">\$date (passata via GET o da controller)</div>
        {/if}
      </div>

      <input type="hidden" name="field_id" value="{if isset($field)}{$field->getId()}{else}\$field->getId(){/if}" />
      <input type="hidden" name="date" value="{if isset($date)}{$date}{else}\$date{/if}" />

      <div class="field">
        <label for="time" class="label">Seleziona orario:</label>
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
