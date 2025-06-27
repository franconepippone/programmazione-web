<h2>Modifica Data Prenotazione</h2>
<form method="post" action="/reservation/modifyReservationTime">
    <input type="hidden" name="id" value="{$reservation.id}">
    <label>Nuova data:</label>
    <input type="date" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}" required>
    <button type="submit">Prosegui alla scelta orario</button>
</form>