{if $active}
    <h2>La tua prenotazione attiva</h2>
    <ul>
        <li><b>Campo:</b> {$reservation.field}</li>
        <li><b>Data:</b> {$reservation.date}</li>
        <li><b>Ora:</b> {$reservation.time}</li>
    </ul>

    <form method="post" action="/reservation/cancelInfo">
        <button type="submit">Cancella prenotazione</button>
    </form>

    <form method="post" action="/user/home">
        <button type="submit">Torna alla homepage</button>
    </form>
{else}
    <h2>Nessuna prenotazione attiva</h2>
    <p>Non hai prenotazioni attive al momento.</p>
    <button type="button" onclick="window.history.back()">Torna indietro</button>
{/if}