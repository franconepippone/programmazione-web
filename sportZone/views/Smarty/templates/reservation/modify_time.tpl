<h2>Modifica Orario Prenotazione</h2>
<form method="post" action="/reservation/confirmModifyReservation">
    <input type="hidden" name="id" value="{$reservation.id}">
    <input type="hidden" name="date" value="{$date}">
    <div>
        <label>Nuovo orario:</label>
        <select name="time" required>
            {foreach $avaiableHours as $hour}
                <option value="{$hour}">{$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}</option>
            {/foreach}
        </select>
    </div>
    <button type="submit">Conferma modifica</button>
</form>