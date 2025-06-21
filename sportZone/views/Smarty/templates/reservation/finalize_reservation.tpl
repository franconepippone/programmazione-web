<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Finalizza Prenotazione</title>
</head>
<body>

  <h2>Riepilogo Prenotazione</h2>

  {if $redirect}
    <script>
      window.location.href = "{$redirect}";
    </script>
  {/if}

  <form method="POST" action="/reservation/finalizeReservation?field_id={$field_id}&date={$date}&time={$time}">

    <p><strong>Sport:</strong>
      {if isset($field)}
        {$field->getSport()}
      {else}
        {$field->getSport()|default:'getSport()'}
      {/if}
    </p>

    <p><strong>Tipo terreno:</strong>
      {if isset($field)}
        {$field->getTerrainType()}
      {else}
        getTerrainType()
      {/if}
    </p>

    <p><strong>Coperto:</strong>
      {if isset($field)}
        {if $field->getIsIndoor()}Sì{else}No{/if}
      {else}
        getIsIndoor()
      {/if}
    </p>

    <p><strong>Costo orario:</strong>
      {if isset($field)}
        €{$field->getCost()|number_format:2}
      {else}
        getCost()
      {/if}
    </p>

    <p><strong>Data:</strong> {$date|default:"getParam('date')"}</p>
    <p><strong>Orario:</strong> {$time|default:"getParam('time')"}</p>

    <input type="hidden" name="field_id" value="{$field_id|default:'getParam(field_id)'}" />
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
