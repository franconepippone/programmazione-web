


<a class="card" href="{$fieldUrl}">
    <img src="{$field.images[0]}">
        <div class="card-body">
          <div>
            <div class="card-title">{$field.name}</div>
            <div class="card-details">
              Sport: {$field.sport}<br>
              Time: 8:00 - 21:00<br>
              {if isset($field.terrainType)}Terrain: {$field.terrainType}<br>{/if}
              {if ($field.isIndoor)}Indoor{/if}
              {if isset($field.illuminazione)}Illuminazione: {$field.illuminazione}<br>{/if}
            </div>
          </div>
        <div class="price">Cost: &euro;{$field.hourlyCost}/h</div>
    </div>
</a>