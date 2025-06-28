{extends file="../dashboard_bar.tpl"}
{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/details.css">
{/block}

{block name="dashboard_content"}
  <h1 class="results-header">Search fields</h1>

<form class="search-form" method="GET" action="/dashboard/manageFields">
    <label>
        Name:
        <input type="text" name="name" value="{$title}" placeholder="football-1">
    </label>
    <label>
        Sport:
        <select name="sport">
            <option value="">-- All sports --</option>
            <option value="football" {if $search.sport == 'football'}selected{/if}>Calcio</option>
            <option value="tennis" {if $search.sport == 'tennis'}selected{/if}>Tennis</option>
            <option value="basket" {if $search.sport == 'basket'}selected{/if}>Basket</option>
            <option value="padel" {if $search.sport == 'padel'}selected{/if}>Padel</option>
            <!-- Altri sport possono essere aggiunti qui -->
        </select>
    </label>
    <button type="submit">Search</button>or
    <a href="/field/createFieldForm" class="add-field-btn" style="text-decoration:none;">
        <button type="button" style="margin-left:10px;">Create field</button>
    </a>
</form>
  <div class="results-container">
    {foreach $fields as $field}
        {assign var="fieldUrl" value="/field/modifyField/{$field.id}"}
        {include file="field/field_card.tpl" field=$field}
    {/foreach}
  </div>
{/block}
