{extends file=$layout}
{assign var="page_title" value="Register new"}

{block name="styles"}
  <style>
    form {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
    }

    input, select, textarea {
      width: 100%;
      padding: 8px 12px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      font-size: 1em;
    }

    button {
      display: block;
      width: 100%;
      max-width: 300px;
      margin: 0 auto;
      padding: 12px;
      font-size: 1.1em;
      border-radius: 8px;
      border: none;
      background-color: #007bff;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    .map-wrapper {
      width: 100%;
      max-width: 600px;
      margin-bottom: 20px;
      margin-left: auto;
      margin-right: auto;
    }

    #map {
      width: 100%;
      height: 400px;
      border-radius: 8px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
  </style>
{/block}

{block name="content"}
  
  <form
  action="/field/finalizeFieldModify/{$field.id}"
  method="post"
  enctype="multipart/form-data"
  >
  <h1>Modify field</h1>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{$field.name}" />

    <label for="sport">Sport:</label>
    <input type="text" id="sport" name="sport" value="{$field.sport}" />

    <label for="terrainType">Terrain type:</label>
    <input type="text" id="terrainType" name="terrainType" value="{$field.terrainType}" />

    <label for="isIndoor">Is indoor?</label>
    <select id="isIndoor" name="isIndoor" required>
      <option value="1">Sì</option>
      <option value="0">No</option>
    </select>

    <label for="hourlyCost">Hourly cost (€):</label>
    <input
      type="number"
      step="0.01"
      id="hourlyCost"
      name="hourlyCost"
      required
      min="0"
      value="{$field.hourlyCost}"
    />

    <label for="description">Description:</label>
    <textarea
      id="description"
      name="description"
      placeholder="Insert a field description"
      rows="4"
    >{$field.description}</textarea>

    <label for="fieldImages">Upload field pictures:</label>
    <input type="file" id="images" name="images[]" accept="image/*" multiple />

    {if isset($images) && $images|@count > 0}
      <div class="field-images-list">
        <label>Current field pictures:</label>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
          {foreach from=$images item=imageUrl}
            <div>
              <img src="{$imageUrl}" alt="Field image" style="max-width: 120px; max-height: 120px; border-radius: 6px; border: 1px solid #ccc;" />
            </div>
          {/foreach}
        </div>
      </div>
    {/if}

    <input type="hidden" id="latitude" name="latitude" value="0" required />
    <input type="hidden" id="longitude" name="longitude" value="0" required />
    <hr style="margin: 32px 0;" />
    <div style="display: flex; gap: 16px; justify-content: center;">
      <button type="submit" style="flex: 1;">Apply changes</button>
      <button type="button" onclick="window.location.href='/field/delete/{$field.id}'" style="flex: 1; background-color: #ff0000;">Delete</button>
    </div>
  </form>

{/block}