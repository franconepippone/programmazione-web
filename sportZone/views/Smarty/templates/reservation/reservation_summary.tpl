<div class="summary-wrapper">
    <h2>Riepilogo Prenotazione</h2>
    <ul>
        <li><b>Utente:</b> {$fullName}</li>
        <li><b>Data:</b> {$date}</li>
        <li><b>Orario:</b> {$time}</li>
        <li><b>Campo:</b> {$fieldData.sport} - {$fieldData.terrainType}</li>
        <li><b>Coperto:</b> {if $fieldData.isIndoor}Sì{else}No{/if}</li>
        <li><b>Costo orario:</b> €{$fieldData.hourlyCost|number_format:2}</li>
    </ul>
    <form method="post" action="/paymentMethod/payForm">
        <input type="hidden" name="field_id" value="{$fieldData.id}">
        <input type="hidden" name="date" value="{$date}">
        <input type="hidden" name="time" value="{$time}">
        <button type="submit">Scegli il metodo di pagamento</button>
    </form>
    <button type="button" onclick="window.history.back()">Torna indietro</button>
</div>