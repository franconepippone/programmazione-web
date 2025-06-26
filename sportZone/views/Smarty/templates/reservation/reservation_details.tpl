<h2 style="text-align:center;">Dettaglio Prenotazione</h2>
<div style="max-width:400px; margin:auto; border:1px solid #ccc; border-radius:8px; padding:24px; background:#fafafa;">
    <ul style="list-style:none; padding:0;">
        <li><b>ID:</b> {$reservation.id}</li>
        <li><b>Data:</b> {$reservation.date}</li>
        <li><b>Ora:</b> {$reservation.time}</li>
        <li><b>Campo:</b> {$reservation.field}</li>
        <li><b>Utente:</b> {$reservation.fullname}</li>
        <li><b>Costo:</b> €{$reservation.cost|number_format:2}</li>
        <li><b>Metodo di pagamento:</b> {$reservation.paymentMethod}</li>
        {if isset($reservation.otherInfo)}
            <li><b>Altre info:</b> {$reservation.otherInfo}</li>
        {/if}
    </ul>
    <div style="text-align:center; margin-top:20px;">
        <a href="/reservation/allReservations" style="padding:8px 16px; border-radius:5px; border:1px solid #888; background:#eee; text-decoration:none; color:#222;">Torna alla lista</a>
    </div>
</div>