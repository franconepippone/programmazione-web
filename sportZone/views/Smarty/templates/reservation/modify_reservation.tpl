{block name="style"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="content"}
    <div class="form-wrapper" style="max-width: 480px;">
        <h2>Modifica Prenotazione</h2>

        <div style="display:flex; gap:1rem; justify-content:center; margin-bottom: 2rem;">
            <form method="post" action="/reservation/modifyReservationDate" style="margin:0;">
                <input type="hidden" name="id" value="{$reservation.id}">
                <button type="submit" class="submit-button">Modifica Data</button>
            </form>
            <form method="post" action="/reservation/modifyReservationTime" style="margin:0;">
                <input type="hidden" name="id" value="{$reservation.id}">
                <input type="hidden" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}">
                <button type="submit" class="submit-button">Modifica Ora</button>
            </form>
        </div>

        <form method="post" action="/reservation/confirmModifyReservation">
            <input type="hidden" name="id" value="{$reservation.id}">
            <div class="form-group">
                <label>Data:</label>
                <input type="date" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}" required readonly>
            </div>
            <div class="form-group">
                <label>Ora:</label>
                <input type="time" name="time" value="{$reservation.time|date_format:'%H:%M'}" required readonly>
            </div>

            <div class="button-container" style="margin-top: 3rem; display: flex; gap: 2rem; justify-content: center;">
                <button type="submit" class="submit-button">Conferma modifica</button>
                <button type="button" class="submit-button" onclick="window.history.back()">Annulla</button>
            </div>
        </form>
    </div>
{/block}