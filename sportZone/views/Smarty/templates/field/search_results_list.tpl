<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Campi Sportivi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef0f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      cursor: pointer;
      text-decoration: none;
      color: inherit;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
    }

    .card-title {
      font-size: 1.2em;
      margin-bottom: 8px;
    }

    .card-details {
      font-size: 0.9em;
      color: #555;
    }

    .price {
      margin-top: 10px;
      font-weight: bold;
      color: #007BFF;
    }
  </style>
</head>
<body>

  <h1>Seleziona un Campo Sportivo</h1>

  <div class="container">
    {foreach $fields as $field}
      <a class="card" href="/field/details/{$field.id}">
        <img src="{$field.image}" alt="{$field.alt}">
        <div class="card-body">
          <div class="card-title">{$field.title}</div>
          <div class="card-details">
            Sport: {$field.sport}<br>
            Orario: {$field.orario}<br>
            {if isset($field.superficie)}Superficie: {$field.superficie}<br>{/if}
            {if isset($field.illuminazione)}Illuminazione: {$field.illuminazione}<br>{/if}
          </div>
          <div class="price">{$field.price}</div>
        </div>
      </a>
    {/foreach}
  </div>

</body>
</html>
