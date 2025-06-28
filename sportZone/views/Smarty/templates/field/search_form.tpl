{extends file=$layout} 
{assign var="page_title" value="Ricerca Campo Sportivo"}

{block name="styles"}
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
{/block}

{block name="content"}
  <div class="container my-5">
    <h2 class="mb-4">Ricerca Campo Sportivo</h2>
    <form action="/field/showResults" method="GET">
      <div class="mb-3">
        <label for="date" class="form-label">Giorno</label>
        <input type="date" id="date" name="date" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="sport" class="form-label">Sport</label>
        <select name="sport" id="sport" class="form-select">
          <option value="">-- Tutti gli sport --</option>
          <option value="football">Calcio</option>
          <option value="tennis" selected>Tennis</option>
          <option value="basket">Basket</option>
          <option value="padel">Padel</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Cerca</button>
    </form>
  </div>
{/block}
