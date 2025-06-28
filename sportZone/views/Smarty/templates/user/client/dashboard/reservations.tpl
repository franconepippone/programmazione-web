{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="reservations"}

{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="dashboard_content"}
    <div class="form-wrapper">
        {if $active}
            <h2>La tua prenotazione attiva</h2>
            <ul class="form-group">
                <li><b>Campo:</b> {$reservation.field}</li>
                <li><b>Data:</b> {$reservation.date}</li>
                <li><b>Ora:</b> {$reservation.time}</li>
            </ul>

            <form method="post" action="/reservation/cancelInfo" class="form-group">
                <button type="submit" class="submit-button">Cancella prenotazione</button>
            </form>

            <form method="post" action="/user/home" class="form-group">
                <button type="submit" class="submit-button">Torna alla homepage</button>
            </form>
        {else}
            <h2>Nessuna prenotazione attiva</h2>
            <p>Non hai prenotazioni attive al momento.</p>
            <form method="post" action="/user/home" class="form-group">
                <button type="submit" class="submit-button">Torna alla homepage</button>
            </form>
        {/if}
    </div>
{/block}
