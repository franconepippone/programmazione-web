{block name="dashboard_tabs_styles"}
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="dashboard_content"}
    <div class="container py-4 d-flex justify-content-center">
        <div class="card shadow-sm" style="max-width: 480px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-center">Modifica Orario Prenotazione</h2>

                <form method="post" action="/reservation/confirmModifyReservation" novalidate>
                    <input type="hidden" name="id" value="{$reservation.id}">
                    <input type="hidden" name="date" value="{$date}">

                    <div class="mb-4">
                        <label for="time" class="form-label">Nuovo orario:</label>
                        <select id="time" name="time" required class="form-select">
                            {foreach $avaiableHours as $hour}
                                <option value="{$hour}">{$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary">Conferma modifica</button>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Annulla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{/block}
