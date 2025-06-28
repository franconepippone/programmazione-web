{block name="styles"} 
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="content"}
    <div class="container py-4 d-flex justify-content-center">
        <div class="card shadow-sm" style="max-width: 480px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title mb-4">Modifica Data Prenotazione</h2>

                <form method="post" action="/reservation/modifyReservationTime" class="mb-3">
                    <input type="hidden" name="id" value="{$reservation.id}">
                    <div class="mb-3">
                        <label for="date" class="form-label">Nuova data:</label>
                        <input type="date" id="date" name="date" 
                               value="{$reservation.date|date_format:'%Y-%m-%d'}" 
                               required 
                               class="form-control">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Prosegui</button>
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