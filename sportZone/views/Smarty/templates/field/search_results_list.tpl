{extends file=$layout} 
{assign var="page_title" value="Available fields"}

{block name="styles"}
{/block}

{block name="content"}
  <div class="container my-4">
    <h1 class="field-results-header mb-4">Select a Sports Field</h1>

    <form method="GET" action="/field/showResults" class="row g-3 align-items-end mb-4">
      <div class="col-md-4">
        <label for="date" class="form-label">Data:</label>
        <input type="date" id="date" name="date" value="{$search.date}" class="form-control">
      </div>
      <div class="col-md-4">
        {include file="field/sport_selection.tpl"}
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-primary w-100">Cerca</button>
      </div>
    </form>

    <div class="row field-results-container">
      {foreach $fields as $field}
        {assign var="fieldUrl" value="/field/details/{$field.id}?{$queryString}"}
        <div class="col-md-4 mb-4">
          {include file="field/field_card.tpl" field=$field}
        </div>
      {/foreach}
    </div>
  </div>
{/block}