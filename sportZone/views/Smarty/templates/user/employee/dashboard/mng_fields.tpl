{extends file="../dashboard_bar.tpl"}

{block name="dashboard_tabs_styles"}
{/block}

{block name="dashboard_content"}
  <div class="container my-4">

    <h1 class="mb-4">Search Fields</h1>

    <form class="row g-3 align-items-end mb-4" method="GET" action="/dashboard/manageFields">
      <div class="col-md-4">
        <label for="fieldName" class="form-label">Name</label>
        <input type="text" class="form-control" id="fieldName" name="name" value="{$title}" placeholder="football-1">
      </div>

      <div class="col-md-4">
        {include file="field/sport_selection.tpl"}
      </div>

      <div class="col-md-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="/field/createFieldForm" class="btn btn-outline-primary">Create Field</a>
      </div>
    </form>

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
