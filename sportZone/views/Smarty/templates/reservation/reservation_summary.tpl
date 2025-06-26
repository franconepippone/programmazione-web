<div class="summary-wrapper">
    <h2>Riepilogo Prenotazione</h2>
    <ul>
        <li><b>Utente:</b> {$fullName}</li>
        <li><b>Data:</b> {$date}</li>
        <li><b>Orario:</b> {$time}</li>
        <li><b>Campo:</b> {$fieldData.sport} - {$fieldData.terrainType}</li>
        <li><b>Coperto:</b> {if $fieldData.isIndoor}Sì{else}No{/if}</li>
        <li><b>Costo orario:</b> €{$fieldData.hourlyCost|number_format:2}</li>
        <li><b>Metodo di pagamento:</b> {if $paymentMethod == 'online'}Online{else}In loco{/if}</li>
    </ul>
    <form method="post" action="{if $paymentMethod == 'online'}/onlinepayment/payForm{else}/reservation/finalizeOnsiteReservation{/if}">
        <input type="hidden" name="field_id" value="{$fieldData.id}">
        <input type="hidden" name="date" value="{$date}">
        <input type="hidden" name="time" value="{$time}">
        <input type="hidden" name="user_id" value="{$userId}">
        <input type="hidden" name="cost" value="{$fieldData.hourlyCost}">
        <input type="hidden" name="paymentMethod" value="{$paymentMethod}">
        <button type="submit" name="confirm">Conferma Prenotazione</button>
    </form>
</div>