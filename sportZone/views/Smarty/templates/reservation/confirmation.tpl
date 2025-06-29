{extends file=$layout}
{assign var="page_title" value="Dashboard - Settings"}
{block name="content"}
    <div class="container py-4">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-3">Prenotazione Confermata</h2>
                <p class="text-center mb-4">La tua prenotazione è stata registrata con successo.</p>

                {if isset($reservation)}
                    <h4 class="mb-3">Dettagli Prenotazione</h4>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">
                            <strong>Data:</strong> {$reservation->getDate()|default:'[data non disponibile]'}
                        </li>
                        <li class="list-group-item">
                            <strong>Orario:</strong> {$reservation->getTime()|default:'[orario non disponibile]'|truncate:5:"":true}
                        </li>
                        <li class="list-group-item">
                            <strong>Campo:</strong>
                            {if $reservation->getField() != null}
                                {$reservation->getField()->getSport()} - {$reservation->getField()->getTipoTerreno()}
                            {else}
                                [campo non disponibile]
                            {/if}
                        </li>
                        <li class="list-group-item">
                            <strong>Metodo di pagamento:</strong>
                            {if $reservation->getPayment() != null}
                                {$reservation->getPayment()->getType()}
                            {else}
                                [non specificato]
                            {/if}
                        </li>
                    </ul>
                {/if}

                <div class="text-center">
                    <a href="/dashboard/myReservations" class="btn btn-primary">
                        Vedi prenotazione
                    </a>
                </div>
            </div>
        </div>
    </div>
{/block}