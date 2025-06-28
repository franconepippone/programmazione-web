{extends file=$layout} 
{assign var="page_title" value="Ricerca Campo Sportivo"}

{block name="styles"}
 
{/block}

{assign var="sports" value=["football", "tennis", "basket", "padel"]}

{block name="content"}
  <div class="container my-5">
    <h2 class="mb-4">Ricerca Campo Sportivo</h2>
    <form action="/field/showResults" method="GET">
      <div class="mb-3">
        <label for="date" class="form-label">Giorno</label>
        <input type="date" id="date" name="date" class="form-control" required>
      </div>
      <div class="mb-3">
        {include file="field/sport_selection.tpl"}
      </div>
      <button type="submit" class="btn btn-primary">Cerca</button>
    </form>
  </div>
{/block}
