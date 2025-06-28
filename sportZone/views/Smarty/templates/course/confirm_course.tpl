{extends file=$layout}
{assign var="page_title" value="Settings"}


{block name="content"}
    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm w-100" style="max-width: 600px;">
            <div class="card-body text-center">
                <h2 class="card-title text-success mb-4">Corso creato con successo!</h2>
                <p class="lead">Il corso <strong>{$data.title|escape}</strong> è stato registrato nel sistema.</p>

                <div class="mt-4 d-grid">
                    <a href="/user/home" class="btn btn-primary fw-semibold">Torna alla homepage</a>
                </div>
            </div>
        </div>
    </div>
{/block}