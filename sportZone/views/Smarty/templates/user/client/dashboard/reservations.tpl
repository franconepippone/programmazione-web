{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="reservations"}

{block name="dashboard_tabs_styles"}
{/block}

{block name="dashboard_content"}
    <div class="results-list container py-4">
        <h2 class="mb-4">La tua prenotazione attiva</h2>
        {if $active}
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <ul class="list-group mb-4">
                                <li class="list-group-item"><strong>Campo:</strong> {$reservation.field}</li>
                                <li class="list-group-item"><strong>Data:</strong> {$reservation.date}</li>
                                <li class="list-group-item"><strong>Ora:</strong> {$reservation.time}</li>
                            </ul>
                            <form method="post" action="/reservation/cancelInfo" class="mb-3 d-grid">
                                <button type="submit" class="btn btn-danger mx-auto" style="min-width: 180px;">Cancella prenotazione</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        {else}
            <p>Non hai prenotazioni attive al momento.</p>
        {/if}
    </div>
{/block}