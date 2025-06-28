{extends file=$layout}
{assign var="page_title" value="Successo"}

{block name="styles"}{/block}

{block name="content"}
    <div class="d-flex align-items-center justify-content-center bg-light" style="min-height: 60vh;">
        <div class="bg-white text-dark p-4 rounded shadow text-center" style="max-width: 400px; width: 100%;">
            <h1 class="mb-3 text-dark fs-2">Successo</h1>
            <p class="mb-4 text-secondary">{$success_message|escape}</p>
            <button type="button" class="btn btn-primary px-4" onclick={$butt_action}>{$butt_name}</button>
        </div>
    </div>
{/block}
