{block name="tyles"} 
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="content"}
    <div class="container py-4 d-flex justify-content-center">
        <div class="card shadow-sm" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-center">Dettaglio Prenotazione</h2>

                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>ID:</strong> {$reservation.id}</li>
                    <li class="list-group-item"><strong>Data:</strong> {$reservation.date}</li>
                    <li class="list-group-item"><strong>Ora:</strong> {$reservation.time}</li>
                    <li class="list-group-item"><strong>Campo:</strong> {$reservation.field}</li>
                    <li class="list-group-item"><strong>Utente:</strong> {$reservation.fullname}</li>
                    <li class="list-group-item"><strong>Costo:</strong> €{$reservation.cost|number_format:2}</li>
                    <li class="list-group-item"><strong>Metodo di pagamento:</strong> {$reservation.paymentMethod}</li>
                    {if isset($reservation.otherInfo)}
                        <li class="list-group-item"><strong>Altre info:</strong> {$reservation.otherInfo}</li>
                    {/if}
                </ul>

                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Torna indietro</button>

                    <form action="/reservation/modifyReservation" method="get" class="m-0">
                        <input type="hidden" name="id" value="{$reservation.id}">
                        <button type="submit" class="btn btn-primary">Modifica</button>
                    </form>

                    <form action="/reservation/cancelReservation" method="get" class="m-0">
                        <input type="hidden" name="id" value="{$reservation.id}">
                        <button type="submit" class="btn btn-danger">Cancella</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}