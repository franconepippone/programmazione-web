<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Riepilogo Prenotazione</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 2rem; background-color: #f5f5f5; }
    h2, h3 { color: #333; }
    ul { background: #fff; padding: 1rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); list-style: none; }
    li { margin-bottom: 0.5rem; }
    label, select, button { display: block; margin-top: 1rem; }
  </style>
</head>
<body>

  <h2>Riepilogo Prenotazione</h2>

  <p><strong>Utente:</strong> 
    {if isset($fullName) && $fullName neq ''}{$fullName}{else}[$client->getName() . ' ' . $client->getSurname()]{/if}
  </p>

  <p><strong>Data:</strong> 
    {if isset($data) && $data neq ''}{$data}{else}[$date = UHTTPMethods::post('data')]{/if}
  </p>

  <p><strong>Orario:</strong> 
    {if isset($orario) && $orario neq ''}{$orario}{else}[$time = UHTTPMethods::post('orario')]{/if}
  </p>

  <h3>Informazioni Campo</h3>
  <ul>
    <li><strong>Sport:</strong> 
      {if isset($campo)}{$campo->getSport()}{else}[$field->getSport()]{/if}
    </li>
    <li><strong>Tipo terreno:</strong> 
      {if isset($campo)}{$campo->getTipoTerreno()}{else}[$field->getTerrainType()]{/if}
    </li>
    <li><strong>Indoor:</strong>
      {if isset($campo)}
        {if $campo->getIndoor()}Indoor{else}Outdoor{/if}
      {else}[$field->getIsIndoor()]{/if}
    </li>
    <li><strong>Costo orario:</strong> 
      {if isset($campo)}{$campo->getCostoOrario()} €{else}[$field->getCost()]{/if}
    </li>
  </ul>

  <form id="reservationForm" method="post" action="/reservation/finalizeReservation">
    <input type="hidden" name="data" value="{$data|default:''}">
    <input type="hidden" name="orario" value="{$orario|default:''}">
    <input type="hidden" name="id" value="{if isset($campo)}{$campo->getId()}{else}[$field->getId()]{/if}">

    <label for="paymentMethod">Metodo di pagamento:</label>
    <select name="paymentMethod" id="paymentMethod" required>
      <option value="onsite">Pagamento in loco</option>
      <option value="online">Pagamento online</option>
    </select>

    <br><br>
    <button type="submit" name="confirm">Conferma Prenotazione</button>
  </form>

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
