{block name="styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="content"}
    <div class="form-wrapper" style="max-width: 480px;">
        <h2>Modifica Data Prenotazione</h2>

        <form method="post" action="/reservation/modifyReservationTime">
            <input type="hidden" name="id" value="{$reservation.id}">

            <div class="form-group">
                <label for="date">Nuova data:</label>
                <input type="date" id="date" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Prosegui alla scelta orario</button>
            </div>
        </form>
    </div>
{/block}