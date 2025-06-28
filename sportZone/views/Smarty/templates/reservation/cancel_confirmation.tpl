{block name="dashboard_tabs_styles"} 
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="dashboard_content"}
    <div class="container py-5">
        <div class="card shadow-sm mx-auto text-center" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-danger">Prenotazione Cancellata</h2>
                <p class="mb-4">La tua prenotazione è stata cancellata con successo.</p>
                <a href="/dashboard/manageReservations" class="btn btn-danger">
                    ← Torna alla lista 
                </a>
            </div>
        </div>
    </div>
{/block}