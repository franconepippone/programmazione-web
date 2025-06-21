<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Prenotazione Campo</title>
</head>
<body>

  <h2>Prenotazione Campo</h2>

  {if isset($field) && isset($date) && isset($availableHours)}
    <form method="get" action="/reservation/finalizeReservation">

      <p><strong>Sport:</strong> {$field->getSport()}</p>
      <p><strong>Tipo terreno:</strong> {$field->getTerrainType()}</p>
      <p><strong>Coperto:</strong> {if $field->getIsIndoor()}Sì{else}No{/if}</p>
      <p><strong>Costo orario:</strong> €{$field->getCost()|number_format:2}</p>
      <p><strong>Data:</strong> {$date}</p>

      <input type="hidden" name="field_id" value="{$field->getId()}" />
      <input type="hidden" name="date" value="{$date}" />

      <label for="time">Seleziona orario:</label>
      <select name="time" id="time" required>
        {foreach $availableHours as $hour}
          <option value="{$hour}">{$hour}</option>
        {/foreach}
      </select>

      <button type="submit">Conferma Orario</button>
    </form>

  {else}
    <p>Errore: dati mancanti per la prenotazione.</p>
  {/if}

</body>
</html>
