{block name="dashboard_tabs_styles"} 
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="dashboard_content"}
    <div class="container py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-danger text-center text-uppercase">Cancellazione Prenotazione</h2>

                {if isset($errorMessage)}
                    <div class="alert alert-danger text-center fw-semibold" role="alert">
                        {$errorMessage}
                    </div>
                {else}
                    <h3 class="mb-3 text-danger border-bottom border-danger pb-2">Riepilogo Prenotazione</h3>

                    <p><strong>ID Prenotazione:</strong> {$reservation.id|default:'-'}</p>
                    <p><strong>Data:</strong> {$reservation.date|date_format:"%Y-%m-%d"|default:'-'}</p>
                    <p><strong>Orario:</strong> {$reservation.time|default:'-'}</p>

                    <p><strong>Campo Sportivo:</strong></p>
                    <ul class="list-group bg-light rounded shadow-sm mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Sport:</strong></span>
                            <span>{$reservation.sport|default:'-'}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Tipo terreno:</strong></span>
                            <span>{$reservation.field|default:'-'}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Indoor:</strong></span>
                            <span>
                                {if isset($reservation.field_indoor)}
                                    {if $reservation.field_indoor}Sì{else}No{/if}
                                {else}
                                    -
                                {/if}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Costo Orario:</strong></span>
                            <span>
                                {if isset($reservation.hourlyCost)}€{$reservation.hourlyCost|number_format:2}{else}-{/if}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Metodo di Pagamento:</strong></span>
                            <span>{$reservation.paymentMethod|capitalize|default:'-'}</span>
                        </li>
                    </ul>

                    <form method="post" action="/reservation/finalizeCancelReservation" class="d-grid">
                        <input type="hidden" name="id" value="{$reservation.id|default:0}">
                        <button type="submit" name="confirm" class="btn btn-danger fw-semibold">Conferma cancellazione</button>
                    </form>
                {/if}
            </div>
        </div>
    </div>
{/block}