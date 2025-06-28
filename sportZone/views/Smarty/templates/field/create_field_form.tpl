{extends file=$layout}
{assign var="page_title" value="Crea Campo"}
{block name="styles"}
  <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}
{block name="content"}
  <div class="form-wrapper">
    <h2>Crea Campo Sportivo</h2>

    <form action="/field/finalizeFieldCreation" method="post" enctype="multipart/form-data">
      
      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-group">
        <label for="sport">Sport</label>
        <input type="text" id="sport" name="sport" required>
      </div>

      <div class="form-group">
        <label for="terrainType">Tipo di terreno</label>
        <input type="text" id="terrainType" name="terrainType" required>
      </div>

      <div class="form-group">
        <label for="isIndoor">È al coperto?</label>
        <select id="isIndoor" name="isIndoor" required>
          <option value="1">Sì</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="form-group">
        <label for="hourlyCost">Costo orario (€)</label>
        <input type="number" id="hourlyCost" name="hourlyCost" step="0.01" min="0" required>
      </div>

      <div class="form-group">
        <label for="description">Descrizione</label>
        <textarea id="description" name="description" rows="4" required></textarea>
      </div>

      <div class="form-group">
        <label for="images">Carica foto del campo</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple>
      </div>


      <input type="hidden" id="latitude" name="latitude" value="0" required>
      <input type="hidden" id="longitude" name="longitude" value="0" required>

      <button type="submit" class="submit-button">Crea campo</button>
    </form>
  </div>

  
{/block}
