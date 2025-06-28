{extends file=$layout}
{block name="content"}
    <div class="container py-5">
        <div class="card shadow-sm mx-auto text-center" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title mb-4">Prenotazione modificata</h2>
                <p class="mb-4">La prenotazione è stata modificata con successo.</p>
                <a href="/dashboard/manageReservations" class="btn btn-primary">
                    Torna alla lista delle prenotazioni
                </a>
            </div>
        </div>
    </div>
{/block}