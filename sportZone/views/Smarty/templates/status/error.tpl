{extends file=$layout}
{assign var="page_title" value="Errore"}

{block name="styles"}{/block}

{block name="content"}
    <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh; background-color: transparent;">
        <div class="bg-danger-subtle border border-danger text-danger-emphasis p-4 rounded shadow-sm text-center" style="max-width: 400px; width: 100%;">
            <h1 class="mb-3 fs-2">Errore</h1>
            <p class="mb-4 fs-6">{$error_message|escape}</p>
            <button type="button" class="btn btn-danger px-4" onclick={$butt_action}>{$butt_name}</button>
        </div>
    </div>
{/block}
