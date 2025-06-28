{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="dashboard_content"}
    <div class="form-wrapper" style="max-width: 480px;">
        <h2>Modifica Orario Prenotazione</h2>
        <form method="post" action="/reservation/confirmModifyReservation">
            <input type="hidden" name="id" value="{$reservation.id}">
            <input type="hidden" name="date" value="{$date}">

            <div class="form-group">
                <label for="time">Nuovo orario:</label>
                <select id="time" name="time" required>
                    {foreach $avaiableHours as $hour}
                        <option value="{$hour}">{$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}</option>
                    {/foreach}
                </select>
            </div>

            <div class="form-group" style="display:flex; justify-content:center; gap:1rem; margin-top:1.5rem;">
                <button type="submit" class="submit-button">Conferma modifica</button>
                <button type="button" class="submit-button" onclick="window.history.back()">Annulla</button>
            </div>
        </form>
    </div>
{/block}