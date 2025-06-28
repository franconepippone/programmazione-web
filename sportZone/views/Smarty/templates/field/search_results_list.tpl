{extends file=$layout} 
{assign var="page_title" value="Selezione Campo Sportivo"}

{block name="styles"}
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="content"}
  <h1 class="mb-4 text-center text-light">Seleziona un Campo Sportivo</h1>

  <form method="GET" action="/field/showResults" class="bg-light rounded p-4 shadow-sm mb-4 d-flex flex-wrap gap-3 justify-content-center">
    <div class="d-flex flex-column" style="min-width:180px;">
      <label for="date" class="form-label fw-bold text-dark">Data:</label>
      <input type="date" id="date" name="date" value="{$search.date}" class="form-control">
    </div>

    <div class="d-flex flex-column" style="min-width:180px;">
      <label for="sport" class="form-label fw-bold text-dark">Sport:</label>
      <select id="sport" name="sport" class="form-select">
        <option value="">-- Tutti gli sport --</option>
        <option value="football" {if $search.sport == 'football'}selected{/if}>Calcio</option>
        <option value="tennis" {if $search.sport == 'tennis'}selected{/if}>Tennis</option>
        <option value="basket" {if $search.sport == 'basket'}selected{/if}>Basket</option>
        <option value="padel" {if $search.sport == 'padel'}selected{/if}>Padel</option>
      </select>
    </div>

    <div class="d-flex align-items-end" style="min-width:120px;">
      <button type="submit" class="btn btn-primary w-100 fw-semibold">Cerca</button>
    </div>
  </form>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    {foreach $fields as $field}
      {assign var="fieldUrl" value="/field/details/{$field.id}?{$queryString}"}
      {include file="field/field_card.tpl" field=$field}
    {/foreach}
  </div>
{/block}
