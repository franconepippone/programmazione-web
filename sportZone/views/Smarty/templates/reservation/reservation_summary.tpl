{block name="styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/styleform.css">
{/block}

{block name="content"}
    <div class="form-wrapper">
        <h2>Riepilogo Prenotazione</h2>

        <ul class="form-group">
            <li><b>Utente:</b> {$fullName}</li>
            <li><b>Data:</b> {$date}</li>
            <li><b>Orario:</b> {$time}</li>
            <li><b>Campo:</b> {$fieldData.sport} - {$fieldData.terrainType}</li>
            <li><b>Coperto:</b> {if $fieldData.isIndoor}Sì{else}No{/if}</li>
            <li><b>Costo orario:</b> €{$fieldData.hourlyCost|number_format:2}</li>
        </ul>

        <form method="post" action="/paymentMethod/payForm" class="form-group">
            <input type="hidden" name="field_id" value="{$fieldData.id}">
            <input type="hidden" name="date" value="{$date}">
            <input type="hidden" name="time" value="{$time}">
            <button type="submit" class="submit-button">Scegli il metodo di pagamento</button>
        </form>

        <div class="form-group">
            <button type="button" class="submit-button" onclick="window.history.back()">Torna indietro</button>
        </div>
    </div>
{/block}