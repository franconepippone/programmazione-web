{extends file=$layout}
{assign var="page_title" value="Successo"}

{block name="styles"}{/block}

{block name="content"}
    <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
        <div class="bg-success-subtle border border-success text-success p-4 rounded shadow-sm text-center" style="max-width: 400px; width: 100%;">
            <h1 class="mb-3 fs-2">Successo</h1>
            <p class="mb-4 text-success-emphasis">{$success_message|escape}</p>
            <button type="button" class="btn btn-success px-4" onclick={$butt_action}>{$butt_name}</button>
        </div>
    </div>
{/block}
