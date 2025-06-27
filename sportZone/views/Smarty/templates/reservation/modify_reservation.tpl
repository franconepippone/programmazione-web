<h2>Modifica Prenotazione</h2>

<form method="post" action="/reservation/confirmModifyReservation">
    <input type="hidden" name="id" value="{$reservation.id}">
    <div>
        <label>Data:</label>
        <input type="date" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}" required readonly>
    </div>
    <div>
        <label>Ora:</label>
        <input type="time" name="time" value="{$reservation.time|date_format:'%H:%M'}" required readonly>
    </div>

    <div style="margin-top:15px;">
        <button type="submit">Conferma modifica</button>
        <button type="button" onclick="window.history.back()">Annulla</button>
    </div>
</form>

<div style="margin-top:20px;">
    <form method="post" action="/reservation/modifyReservationDate" style="display:inline;">
        <input type="hidden" name="id" value="{$reservation.id}">
        <button type="submit">Modifica Data</button>
    </form>
    <form method="post" action="/reservation/modifyReservationTime" style="display:inline;">
        <input type="hidden" name="id" value="{$reservation.id}">
        <input type="hidden" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}">
        <button type="submit">Modifica Ora</button>
    </form>
</div>