<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Prenotazione Campo (Test)</title>
  <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/styleform.css" />
</head>
<body>

  <div class="container">

    <h2>Prenotazione Campo</h2>

    <form method="POST" action="/reservation/reservationSummary" novalidate>

      <div class="field">
        <label class="label">Sport:</label>
        {if isset($fieldData)}
          <div>{$fieldData.sport|escape}</div>
        {else}
          <div class="method-hint">\$fieldData['sport']</div>
        {/if}
      </div>

      <div class="field">
        <label class="label">Tipo terreno:</label>
        {if isset($fieldData)}
          <div>{$fieldData.terrainType|escape}</div>
        {else}
          <div class="method-hint">\$fieldData['terrainType']</div>
        {/if}
      </div>

      <div class="field">
        <label class="label">Coperto:</label>
        {if isset($fieldData)}
          <div>{if $fieldData.isIndoor}Sì{else}No{/if}</div>
        {else}
          <div class="method-hint">\$fieldData['isIndoor'] → true = Sì / false = No</div>
        {/if}
      </div>

      <div class="field">
        <label class="label">Costo orario:</label>
        {if isset($fieldData)}
          <div>€{$fieldData.hourlyCost|number_format:2}</div>
        {else}
          <div class="method-hint">\$fieldData['hourlyCost']</div>
        {/if}
      </div>

      
      </div><div class="field">
        <label class="label">Data:</label>
        {if isset($date)}
          <div>{$date|escape}</div>
        {else}
          <div class="method-hint">\$date (passata via GET o da controller)</div>
        {/if}

      <input type="hidden" name="field_id" value="{if isset($fieldData)}{$fieldData.id}{else}0{/if}" />
      <input type="hidden" name="date" value="{if isset($date)}{$date|escape}{else}''{/if}" />

      <div class="field">
  <label for="time" class="label">Seleziona orario:</label>
  <select name="time" id="time" required>
    {if isset($avaiableHours)}
      {foreach $avaiableHours as $hour}
        {assign var="h" value=$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}
        <option value="{$h}">{$h}</option>
      {/foreach}
    {else}
      <option disabled selected>
        -- \$avaiableHours (es. da FReservation::getAvaiableHours()) --
      </option>
    {/if}
  </select>
</div>

<div class="field">
        <label for="paymentMethod" class="label">Metodo di pagamento:</label>
        <select name="paymentMethod" id="paymentMethod" required>
            <option value="onsite">Pagamento in loco</option>
            <option value="online">Pagamento online</option>
        </select>
    </div>

      <button type="submit">Conferma Orario</button>
    </form>
  </div>

</body>
</html>
