{block name="styles"}
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="content"}
    <div class="container py-4">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Riepilogo Prenotazione</h2>

                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Utente:</strong> {$fullName}</li>
                    <li class="list-group-item"><strong>Data:</strong> {$date}</li>
                    <li class="list-group-item"><strong>Orario:</strong> {$time|truncate:5:"":true}</li>
                    <li class="list-group-item"><strong>Campo:</strong> {$fieldData.sport} - {$fieldData.terrainType}</li>
                    <li class="list-group-item"><strong>Coperto:</strong> {if $fieldData.isIndoor}Sì{else}No{/if}</li>
                    <li class="list-group-item"><strong>Costo orario:</strong> €{$fieldData.hourlyCost|number_format:2}</li>
                </ul>

                <form method="post" action="/paymentMethod/payForm" class="mb-3">
                    <input type="hidden" name="field_id" value="{$fieldData.id}">
                    <input type="hidden" name="date" value="{$date}">
                    <input type="hidden" name="time" value="{$time}">
                    <button type="submit" class="btn btn-primary w-100">Scegli il metodo di pagamento</button>
                </form>

                <div class="d-grid">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Torna indietro</button>
                </div>
            </div>
        </div>
    </div>
{/block}