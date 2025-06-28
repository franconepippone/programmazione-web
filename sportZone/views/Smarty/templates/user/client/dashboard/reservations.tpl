{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="reservations"}

{block name="dashboard_tabs_styles"}
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="dashboard_content"}
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                {if $active}
                    <h2 class="card-title mb-4">La tua prenotazione attiva</h2>
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Campo:</strong> {$reservation.field}</li>
                        <li class="list-group-item"><strong>Data:</strong> {$reservation.date}</li>
                        <li class="list-group-item"><strong>Ora:</strong> {$reservation.time}</li>
                    </ul>

                    <form method="post" action="/reservation/cancelInfo" class="mb-3">
                        <button type="submit" class="btn btn-danger w-100">Cancella prenotazione</button>
                    </form>

                    <form method="post" action="/user/home">
                        <button type="submit" class="btn btn-secondary w-100">Torna alla homepage</button>
                    </form>
                {else}
                    <h2 class="card-title mb-3">Nessuna prenotazione attiva</h2>
                    <p class="mb-4">Non hai prenotazioni attive al momento.</p>
                    <form method="post" action="/user/home">
                        <button type="submit" class="btn btn-primary w-100">Torna alla homepage</button>
                    </form>
                {/if}
            </div>
        </div>
    </div>
{/block}
