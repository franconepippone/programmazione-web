{extends file=$layout}
{assign var="page_title" value="Cancel reservation"}

{block name="styles"} 
{/block}

{block name="content"}
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
                    <p><strong>Utente:</strong> {$reservation.fullname|default:'-'}</p>

                    <p><strong>Campo Sportivo:</strong></p>
                    <ul class="list-group bg-light rounded shadow-sm mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Nome:</strong></span>
                            <span>{$field.name|default:'-'}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Sport:</strong></span>
                            <span>{$field.sport|default:'-'}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Tipo terreno:</strong></span>
                            <span>{$field.terrainType|default:'-'}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Indoor:</strong></span>
                            <span>
                                {if isset($field.isIndoor)}
                                    {if $field.isIndoor}Sì{else}No{/if}
                                {else}
                                    -
                                {/if}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Costo Orario:</strong></span>
                            <span>
                                {if isset($field.hourlyCost)}€{$field.hourlyCost|number_format:2}{else}-{/if}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Metodo di Pagamento:</strong></span>
                            <span>{$reservation.paymentMethod|capitalize|default:'-'}</span>
                        </li>
                    </ul>

                    <div class="d-flex gap-3">
                        <form method="get" action="/reservation/reservationDetails" class="w-100">
                            <input type="hidden" name="id" value="{$reservation.id|default:0}">
                            <button type="submit" class="btn btn-secondary w-100 fw-semibold">Torna indietro</button>
                        </form>

                        <form method="post" action="/reservation/finalizeCancelReservation" class="w-100">
                            <input type="hidden" name="id" value="{$reservation.id|default:0}">
                            <button type="submit" name="confirm" class="btn btn-danger w-100 fw-semibold">Conferma cancellazione</button>
                        </form>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}
