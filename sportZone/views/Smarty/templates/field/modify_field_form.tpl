{extends file=$layout}  
{assign var="page_title" value="Register new"}

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
      <h1 class="mb-4">Modify field</h1>

      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" name="name" value="{$field.name}" class="form-control" />
      </div>

      <div class="mb-3">
        <label for="sport" class="form-label">Sport:</label>
        <input type="text" id="sport" name="sport" value="{$field.sport}" class="form-control" />
      </div>

      <div class="mb-3">
        <label for="terrainType" class="form-label">Terrain type:</label>
        <input type="text" id="terrainType" name="terrainType" value="{$field.terrainType}" class="form-control" />
      </div>

      <div class="mb-3">
        <label for="isIndoor" class="form-label">Is indoor?</label>
        <select id="isIndoor" name="isIndoor" class="form-select" required>
          <option value="1">Sì</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="hourlyCost" class="form-label">Hourly cost (€):</label>
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
        <label for="description" class="form-label">Description:</label>
        <textarea
          id="description"
          name="description"
          rows="4"
          class="form-control"
          placeholder="Insert a field description"
        >{$field.description}</textarea>
      </div>

      <div class="mb-3">
        <label for="images" class="form-label">Upload field pictures:</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple class="form-control" />
      </div>

      {if isset($images) && $images|@count > 0}
        <div class="mb-3">
          <label class="form-label">Current field pictures:</label>
          <div class="d-flex flex-wrap gap-2">
            {foreach from=$images item=imageUrl}
              <div class="overflow-hidden" style="max-width: 120px;">
                <img src="{$imageUrl}" alt="Field image" class="img-thumbnail w-100" />
              </div>
            {/foreach}
          </div>
        </div>
      {/if}

      <input type="hidden" id="latitude" name="latitude" value="0" required />
      <input type="hidden" id="longitude" name="longitude" value="0" required />

      <hr class="my-4" />

      <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button type="submit" class="btn btn-primary">Apply changes</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='/field/delete/{$field.id}'">Delete</button>
      </div>
    </form>
  </div>
{/block}
