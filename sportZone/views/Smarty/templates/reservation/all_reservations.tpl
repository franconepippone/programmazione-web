<h2>Tutte le prenotazioni</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Ora</th>
            <th>Campo</th>
            <th>Utente</th>
            <th>Metodo di pagamento</th>
        </tr>
    </thead>
    <tbody>
    {foreach $reservations as $res}
        <tr style="cursor:pointer" onclick="window.location.href='/reservation/reservationDetail?id={$res.id}'">
            <td>{$res.id}</td>
            <td>{$res.date}</td>
            <td>{$res.time}</td>
            <td>{$res.field}</td>
            <td>{$res.client}</td>
            <td>{$res.paymentMethod}</td>
        </tr>
    {/foreach}
    </tbody>
</table>

<br>
<button onclick="window.history.back()">Torna indietro</button>