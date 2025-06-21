<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Finalizza Prenotazione</title>
</head>
<body>

  <h2>Riepilogo Prenotazione</h2>

  <form method="POST" action="/reservation/finalizeReservation">

    <p><strong>Sport:</strong> {if isset($field)}{$field->getSport()}{else}Campo non disponibile (usa getSport()){ /if}</p>
    <p><strong>Tipo terreno:</strong> {if isset($field)}{$field->getTerrainType()}{else}Tipo sconosciuto (usa getTerrainType()){ /if}</p>
    <p><strong>Coperto:</strong> 
      {if isset($field)}
        {if $field->getIsIndoor()}Sì{else}No{/if}
      {else}
        Informazione non disponibile (usa getIsIndoor())
      {/if}
    </p>
    <p><strong>Costo orario:</strong> €{if isset($field)}{$field->getCost()|number_format:2}{else}0.00 (usa getCost()){ /if}</p>

    <p><strong>Data:</strong> {$date|default:"Data non disponibile"}</p>
    <p><strong>Orario:</strong> {$time|default:"Orario non disponibile"}</p>

    <input type="hidden" name="field_id" value="{$field_id|default:1}" />
    <input type="hidden" name="date" value="{$date|default:''}" />
    <input type="hidden" name="time" value="{$time|default:''}" />

    <label for="payment_method">Metodo di pagamento:</label>
    <select name="payment_method" id="payment_method" required>
      <option value="online">Online</option>
      <option value="onsite">In sede</option>
    </select>

    <button type="submit">Conferma Prenotazione</button>

  </form>

</body>
</html>
