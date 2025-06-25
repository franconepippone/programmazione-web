<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Riepilogo Prenotazione</title>
  <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/styleform.css" />
</head>
<body>

  <section class="container">
    <h2>Riepilogo Prenotazione</h2>

    <!-- Back link -->
    <a href="/reservation/createReservation" class="back-link" title="Torna alla pagina precedente">
      ← Torna indietro
    </a>

    <p><strong>Utente:</strong>
      {if isset($fullName) && $fullName neq ''}{$fullName}{else}[\$client->getName() . ' ' . \$client->getSurname()]{/if}
    </p>

    <p><strong>Data:</strong>
      {if isset($date) && $date neq ''}{$date}{else}[\$date = UHTTPMethods::post('date')]{/if}
    </p>

    <p><strong>Orario:</strong>
      {if isset($time) && $time neq ''}{$time}{else}[\$time = UHTTPMethods::post('time')]{/if}
    </p>

    <h3>Informazioni Campo</h3>
    <ul>
      <li><strong>Sport:</strong>
        {if isset($fieldData)}{$fieldData.sport|escape}{else}[\$fieldData['sport']]{/if}
      </li>
      <li><strong>Tipo terreno:</strong>
        {if isset($fieldData)}{$fieldData.terrainType|escape}{else}[\$fieldData['terrainType']]{/if}
      </li>
      <li><strong>Indoor:</strong>
        {if isset($fieldData)}
          {if $fieldData.isIndoor}Indoor{else}Outdoor{/if}
        {else}
          [\$fieldData['isIndoor']]
        {/if}
      </li>
      <li><strong>Costo orario:</strong>
        {if isset($fieldData)}€{$fieldData.hourlyCost|number_format:2}{else}[\$fieldData['hourlyCost']]{/if}
      </li>
    </ul>

    <form id="reservationForm" method="post" action="/reservation/finalizeReservation">
      <input type="hidden" name="date" value="{$date|default:''}">
      <input type="hidden" name="time" value="{$time|default:''}">
      <input type="hidden" name="field_id" value="{if isset($fieldData)}{$fieldData.id}{else}0{/if}">

      <label for="paymentMethod"><strong>Metodo di pagamento:</strong></label>
      <select name="paymentMethod" id="paymentMethod" required>
        <option value="onsite">Pagamento in loco</option>
        <option value="online">Pagamento online</option>
      </select>

      <button type="submit" name="confirm">Conferma Prenotazione</button>
    </form>
  </section>

  <script>
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
      const metodo = document.getElementById('paymentMethod').value;
      this.action = metodo === 'online'
        ? '/onlinepayment/payForm'
        : '/reservation/finalizeReservation';
    });
  </script>

</body>
</html>
