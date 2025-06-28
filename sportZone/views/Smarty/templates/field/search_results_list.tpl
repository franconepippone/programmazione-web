{extends file=$layout}
{assign var="page_title" value="Selezione Campo Sportivo"}

{block name="styles"}
  <style>
    .results-header {
      margin-bottom: 10px;
      text-align: center;
      color: #1f2937;
    }

    .search-form {
      background-color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      margin: 0 0 30px 0;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: center;
      max-width: 100%;
      width: 100%;
      box-sizing: border-box;
      justify-content: center;
    }

    .search-form label {
      display: flex;
      flex-direction: column;
      font-weight: bold;
      font-size: 0.95em;
      color: #1f2937;
      min-width: 180px;
    }

    .search-form input,
    .search-form select,
    .search-form button {
      padding: 8px;
      font-size: 1em;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 5px;
      font-family: inherit;
    }

    .search-form button {
      background-color: #2563eb;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.2s;
      font-weight: 600;
      min-width: 120px;
    }

    .search-form button:hover {
      background-color: #1e40af;
    }

    .results-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 20px;
      margin-top: 1.5rem;
      width: 100vw;
      margin-left: 50%;
      transform: translateX(-50%);
      box-sizing: border-box;
      padding: 0 2vw;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      cursor: pointer;
      text-decoration: none;
      color: inherit;
      transition: transform 0.2s, box-shadow 0.2s;
      display: flex;
      flex-direction: column;
      min-height: 340px;
    }

    .card:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 24px rgba(0,0,0,0.13);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      background: #f3f4f6;
    }

    .card-body {
      padding: 15px;
      flex: 1 1 auto;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-title {
      font-size: 1.15em;
      margin-bottom: 8px;
      color: #1f2937;
      font-weight: 600;
    }

    .card-details {
      font-size: 0.97em;
      color: #374151;
      margin-bottom: 8px;
    }

    .price {
      margin-top: 10px;
      font-weight: bold;
      color: #2563eb;
      font-size: 1.08em;
    }
  </style>
{/block}

{block name="content"}
  <h1 class="results-header">Seleziona un Campo Sportivo</h1>

  <form class="search-form" method="GET" action="/field/showResults">
    <label>
      Data:
      <input type="date" name="date" value="{$search.date}">
    </label>
    <label>
      Sport:
      <select name="sport">
        <option value="">-- Tutti gli sport --</option>
        <option value="football" {if $search.sport == 'football'}selected{/if}>Calcio</option>
        <option value="tennis" {if $search.sport == 'tennis'}selected{/if}>Tennis</option>
        <option value="basket" {if $search.sport == 'basket'}selected{/if}>Basket</option>
        <option value="padel" {if $search.sport == 'padel'}selected{/if}>Padel</option>
        <!-- Altri sport possono essere aggiunti qui -->
      </select>
    </label>
    <button type="submit">Cerca</button>
  </form>
  
  
  <div class="results-container">
    {foreach $fields as $field}
      {assign var="fieldUrl" value="/field/details/{$field.id}?{$queryString}"}
      {include file="field/field_card.tpl" field=$field}
    {/foreach}
  </div>
{/block}