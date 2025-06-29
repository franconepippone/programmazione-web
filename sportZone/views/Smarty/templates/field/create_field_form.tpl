{extends file=$layout}
{assign var="page_title" value="Crea Campo"}
{block name="styles"}
{/block}
{block name="content"}
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="card-title mb-4 text-center">Crea Campo Sportivo</h2>
            <form action="/field/finalizeFieldCreation" method="post" enctype="multipart/form-data">
              
              <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>

              <div class="mb-3">
                {assign var="Mandatory" value=true}
                {include file="field/sport_selection.tpl"}
              </div>

              <div class="mb-3">
                <label for="terrainType" class="form-label">Tipo di terreno</label>
                <input type="text" class="form-control" id="terrainType" name="terrainType" required>
              </div>

              <div class="mb-3">
                <label for="isIndoor" class="form-label">È al coperto?</label>
                <select class="form-select" id="isIndoor" name="isIndoor" required>
                  <option value="1">Sì</option>
                  <option value="0">No</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="hourlyCost" class="form-label">Costo orario (€)</label>
                <input type="number" class="form-control" id="hourlyCost" name="hourlyCost" step="0.01" min="0" required>
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
              </div>

              <div class="mb-3">
                <label for="images" class="form-label">Carica foto del campo</label>
                <input class="form-control" type="file" id="images" name="images[]" accept="image/*" multiple>
              </div>

              <input type="hidden" id="latitude" name="latitude" value="0" required>
              <input type="hidden" id="longitude" name="longitude" value="0" required>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Crea campo</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  
{/block}
