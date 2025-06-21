<h2>Riepilogo Prenotazione</h2>
<p>Campo: {$field->getSport()}</p>
<p>Data: {$date}</p>
<p>Ora: {$time}</p>

<form method="POST" action="/reservation/finalizeReservation">
  <input type="hidden" name="field_id" value="{$field->getId()}" />
  <input type="hidden" name="date" value="{$date}" />
  <input type="hidden" name="time" value="{$time}" />

  <label for="payment_method">Metodo di pagamento:</label>
  <select name="payment_method" id="payment_method" required>
    <option value="onsite">Pagamento in loco</option>
    <option value="online">Pagamento online</option>
  </select>

  <button type="submit">Conferma</button>
</form>
