{extends file=$layout}
{assign var="page_title" value="Dashboard - Settings"}
{block name="content"}
    <div class="container py-4 d-flex justify-content-center">
        <div class="card shadow-sm" style="max-width: 480px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title mb-4">Modifica Orario Prenotazione</h2>

                <form method="post" action="/reservation/confirmModifyReservation" class="mb-3">
                    <input type="hidden" name="id" value="{$reservation.id}">
                    <input type="hidden" name="date" value="{$date}">

                    <div class="mb-3">
                        <label for="time" class="form-label">Nuovo orario:</label>
                        <select id="time" name="time" required class="form-select">
                            {foreach $avaiableHours as $hour}
                                <option value="{$hour}">{$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Conferma modifica</button>
                    </div>
                </form>

                <form method="get" action="/reservation/modifyReservation" class="mt-2">
                    <input type="hidden" name="id" value="{$reservation.id}">
                    <button type="submit" class="btn btn-secondary w-100">Annulla</button>
                </form>
            </div>
        </div>
    </div>
{/block}