{extends file=$layout}
{assign var="page_title" value="Ricerca Campo Sportivo"}

{block name="styles"}
  <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="content"}
  <div class="form-wrapper">
    <h2>Ricerca Campo Sportivo</h2>
    <form action="/field/showResults" method="GET">
      <div class="form-group">
        <label for="date">Giorno</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="sport">Sport</label>
        <select name="sport" id="sport">
          <option value="">-- Tutti gli sport --</option>
          <option value="football">Calcio</option>
          <option value="tennis" selected>Tennis</option>
          <option value="basket">Basket</option>
          <option value="padel">Padel</option>
        </select>
      </div>
      <button type="submit" class="submit-button">Cerca</button>
    </form>
  </div>
{/block}