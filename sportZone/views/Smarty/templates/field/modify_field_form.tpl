{extends file=$layout}  
{assign var="page_title" value="Modifica campo"}

{block name="styles"}
{/block}

{block name="content"}
  <div class="container my-5" style="max-width: 900px;">
    <form
      action="/field/finalizeFieldModify/{$field.id}"
      method="post"
      enctype="multipart/form-data"
      class="p-4 bg-light rounded shadow"
    >
      <h1 class="mb-4">Modifica campo</h1>

      <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input type="text" id="name" name="name" value="{$field.name}" class="form-control" />
      </div>

      <div class="mb-3">
        {assign var="Mandatory" value=true}
        {include file="field/sport_selection.tpl"}
      </div>

      <div class="mb-3">
        <label for="terrainType" class="form-label">Tipo di terreno:</label>
        <input type="text" id="terrainType" name="terrainType" value="{$field.terrainType}" class="form-control" />
      </div>

      <div class="mb-3">
        <label for="isIndoor" class="form-label">Al chiuso?</label>
        <select id="isIndoor" name="isIndoor" class="form-select" required>
          <option value="1">Sì</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="hourlyCost" class="form-label">Costo orario (€):</label>
        <input
          type="number"
          step="0.01"
          id="hourlyCost"
          name="hourlyCost"
          min="0"
          required
          value="{$field.hourlyCost}"
          class="form-control"
        />
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Descrizione:</label>
        <textarea
          id="description"
          name="description"
          rows="4"
          class="form-control"
          placeholder="Inserisci una descrizione del campo"
        >{$field.description}</textarea>
      </div>

      <div class="mb-3">
        <label for="images" class="form-label">Carica immagini del campo:</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple class="form-control" />
      </div>

      {if isset($images) && $images|@count > 0}
        <div class="mb-3">
          <label class="form-label">Immagini attuali del campo:</label>
          <div class="d-flex flex-wrap gap-2">
            {foreach from=$images item=imageUrl}
              <div class="overflow-hidden" style="max-width: 120px;">
                <img src="{$imageUrl}" alt="Immagine campo" class="img-thumbnail w-100" />
              </div>
            {/foreach}
          </div>
        </div>
      {/if}

      <input type="hidden" id="latitude" name="latitude" value="0" required />
      <input type="hidden" id="longitude" name="longitude" value="0" required />

      <hr class="my-4" />

      <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button type="submit" class="btn btn-primary">Applica modifiche</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='/field/delete/{$field.id}'">Elimina</button>
      </div>
    </form>
  </div>
{/block}