{extends file=$layout}
{assign var="page_title" value="Annulla prenotazione"}

{block name="styles"} 
{/block}

{block name="content"}
    <div class="container py-4">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title mb-3 text-center">Annulla prenotazione</h2>
                <p class="mb-4 text-center">Per annullare questa prenotazione, ti preghiamo di contattarci.</p>

                <div class="d-grid">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Torna indietro</button>
                </div>
            </div>
        </div>
    </div>
{/block}
