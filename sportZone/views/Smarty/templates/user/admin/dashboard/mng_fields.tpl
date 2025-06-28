{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageFields"}

{block name="dashboard_tabs_styles"}
{/block}

{block name="dashboard_content"}
<div class="container py-4" style="max-width: 900px;">
    <h2 class="mb-4">Gestisci Campi Sportivi</h2>

    <form class="row g-3 mb-4" method="GET" action="/dashboard/manageFields">
        <div class="col-md-4">
            <label for="fieldName" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="fieldName" name="name" value="{$title}" placeholder="football-1">
        </div>

        <div class="col-md-4">
            <label for="sport" class="form-label">Sport:</label>
            {include file="field/sport_selection.tpl"}
        </div>

        <div class="col-md-4 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary">Cerca</button>
            <a href="/field/createFieldForm" class="btn btn-outline-primary">Crea Campo</a>
        </div>
    </form>

    <hr>

    {* Tieni tutto il codice sotto inalterato (griglia dei risultati) *}
    <h4 class="mb-4">Risultati:</h4>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        {foreach $fields as $field}
            <div class="col">
                {assign var="fieldUrl" value="/field/modifyField/{$field.id}"}
                {include file="field/field_card.tpl" field=$field}
            </div>
        {/foreach}
    </div>
</div>
{/block}

