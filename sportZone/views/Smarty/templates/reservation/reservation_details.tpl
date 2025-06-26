<h2>Dettaglio Prenotazione</h2>
<ul>
    <li><b>ID:</b> {$reservation.id}</li>
    <li><b>Data:</b> {$reservation.date}</li>
    <li><b>Ora:</b> {$reservation.time}</li>
    <li><b>Campo:</b> {$reservation.field}</li>
    <li><b>Utente:</b> {$reservation.client}</li>
    <li><b>Metodo di pagamento:</b> {$reservation.paymentMethod}</li>
    
</ul>

<form method="post" action="/reservation/modifyReservation" style="display:inline;">
    <input type="hidden" name="id" value="{$reservation.id}">
    <button type="submit">Modifica</button>
</form>

<form method="post" action="/reservation/cancelReservation" style="display:inline;" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
    <input type="hidden" name="id" value="{$reservation.id}">
    <button type="submit">Elimina</button>
</form>

<br><br>
<button onclick="window.history.back()">Torna indietro</button>