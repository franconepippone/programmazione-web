{extends file=$layout}
{assign var="page_title" value="Dashboard - Settings"}
{block name="content"}
    <div class="container py-4 d-flex justify-content-center">
        <div class="card shadow-sm" style="max-width: 480px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-center">Modifica Prenotazione</h2>

                <div class="d-flex justify-content-center gap-3 mb-4">
                    <form method="post" action="/reservation/modifyReservationDate" class="m-0">
                        <input type="hidden" name="id" value="{$reservation.id}">
                        <button type="submit" class="btn btn-outline-primary">Modifica Data</button>
                    </form>

                    <form method="post" action="/reservation/modifyReservationTime" class="m-0">
                        <input type="hidden" name="id" value="{$reservation.id}">
                        <input type="hidden" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}">
                        <button type="submit" class="btn btn-outline-primary">Modifica Ora</button>
                    </form>
                </div>

                <form method="post" action="/reservation/confirmModifyReservation" novalidate>
                    <input type="hidden" name="id" value="{$reservation.id}">

                    <div class="mb-3">
                        <label class="form-label">Data:</label>
                        <input type="date" name="date" value="{$reservation.date|date_format:'%Y-%m-%d'}" required readonly class="form-control-plaintext">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ora:</label>
                        <input type="time" name="time" value="{$reservation.time|date_format:'%H:%M'}" required readonly class="form-control-plaintext">
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary">Conferma modifica</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='/reservation/reservationDetails?id={$reservation.id}'">Annulla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{/block}