<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Prenotazione Campo (Test)</title>
</head>
<body>

  <h2>Prenotazione Campo (Modalità Test)</h2>

  <form method="POST" action="/reservation/finalizeReservation">

    <p><strong>Sport:</strong> {if isset($field)}{$field->getSport()}{else}Calcio{/if}</p>
    <p><strong>Tipo terreno:</strong> {if isset($field)}{$field->getTerrainType()}{else}Erba sintetica{/if}</p>
    <p><strong>Coperto:</strong> 
      {if isset($field)}
        {if $field->getIsIndoor()}Sì{else}No{/if}
      {else}
        No
      {/if}
    </p>
    <p><strong>Costo orario:</strong> €{if isset($field)}{$field->getCost()|number_format:2}{else}20.00{/if}</p>

    {assign var="selectedDate" value=$date|default:"2025-06-23"}
    <p><strong>Data:</strong> {$selectedDate}</p>

    <input type="hidden" name="field_id" value="{if isset($field)}{$field->getId()}{else}1{/if}" />
    <input type="hidden" name="date" value="{$selectedDate}" />

    <label for="time">Seleziona orario:</label>
    <select name="time" id="time" required>
      {if isset($availableHours)}
        {foreach $availableHours as $hour}
          <option value="{$hour}">{$hour}</option>
        {/foreach}
      {else}
        <option value="09:00">09:00</option>
        <option value="10:00">10:00</option>
        <option value="11:00">11:00</option>
      {/if}
    </select>

    <button type="submit">Conferma Orario</button>
  </form>

</body>
</html>
