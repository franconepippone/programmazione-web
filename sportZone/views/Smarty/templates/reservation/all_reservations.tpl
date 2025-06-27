<h2 style="text-align:center;">Tutte le prenotazioni</h2>
<table style="margin:auto; border-collapse:collapse; min-width:500px;">
    <thead>
        <tr style="background:#f0f0f0;">
            <th style="padding:8px; border:1px solid #ccc;">Campo</th>
            <th style="padding:8px; border:1px solid #ccc;">Data</th>
            <th style="padding:8px; border:1px solid #ccc;">Orario</th>
            <th style="padding:8px; border:1px solid #ccc;">Utente</th>
        </tr>
    </thead>
    <tbody>
    {foreach $reservations as $res}
        <tr style="cursor:pointer;" onclick="window.location.href='/reservation/reservationDetails?id={$res.id}'">
            <td style="padding:8px; border:1px solid #ccc;">{$res.field}</td>
            <td style="padding:8px; border:1px solid #ccc;">{$res.date}</td>
            <td style="padding:8px; border:1px solid #ccc;">{$res.time}</td>
            <td style="padding:8px; border:1px solid #ccc;">{$res.fullname}</td>
        </tr>
    {/foreach}
    </tbody>
</table>

<div style="text-align:center; margin-top:20px;">
    <button onclick="window.history.back()" style="padding:8px 16px; border-radius:5px; border:1px solid #888; background:#eee;">Torna indietro</button>
</div>