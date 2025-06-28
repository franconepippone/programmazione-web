{block name="styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/styleform.css">
{/block}

{block name="content"}
    <div class="form-wrapper">
        <h2>Prenotazione Campo</h2>

        <form method="POST" action="/reservation/reservationSummary">
            <div class="form-group">
                <b>Campo:</b> {$fieldData.sport} - {$fieldData.terrainType}
            </div>

            <div class="form-group">
                <b>Data:</b> {$date}
            </div>

            <div class="form-group">
                <label for="time">Orario:</label>
                <select name="time" id="time" required>
                    {foreach $avaiableHours as $hour}
                        <option value="{$hour}">{$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}</option>
                    {/foreach}
                </select>
            </div>

            <input type="hidden" name="field_id" value="{$fieldData.id}">
            <input type="hidden" name="date" value="{$date}">

            <div class="form-group">
                <button type="submit" class="submit-button">Prosegui</button>
            </div>

            <div class="form-group">
                <button type="button" class="submit-button" onclick="window.history.back()">Torna indietro</button>
            </div>
        </form>
    </div>
{/block}