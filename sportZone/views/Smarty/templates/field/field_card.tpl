

<a class="card mb-3 h-100 d-flex flex-column" style="height: 350px; width: auto; text-decoration: none;" href="{$fieldUrl}">
  <div class="ratio ratio-16x9">
    <img src="{$field.images[0]}" class="card-img-top object-fit-cover" alt="{$field.name}" style="height: 100%; width: 100%;">
  </div>
  <div class="card-body d-flex flex-column flex-grow-1">
    <h5 class="card-title">{$field.name}</h5>
    <p class="card-text mb-2">
      <strong>Sport:</strong> {$field.sport}<br>
      <strong>Time:</strong> 8:00 - 21:00<br>
      {if isset($field.terrainType)}<strong>Terrain:</strong> {$field.terrainType}<br>{/if}
      {if ($field.isIndoor)}<strong>Indoor</strong><br>{/if}
      {if isset($field.illuminazione)}<strong>Illuminazione:</strong> {$field.illuminazione}<br>{/if}
    </p>
    <div class="card-footer bg-transparent border-0 p-0 mt-auto">
      <span class="fw-bold text-primary">Cost: &euro;{$field.hourlyCost}/h</span>
    </div>
  </div>
</a>
