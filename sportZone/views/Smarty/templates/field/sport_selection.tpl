{if isset($search)}
    {assign var="sport" value=$search.sport}
{/if}

<label for="sport" class="form-label">Sport</label>
<select name="sport" id="sport" class="form-select">
    <option value="">-- All sports --</option>
    <option value="football" {if $sport == 'football'}selected{/if}>Calcio</option>
    <option value="tennis" {if $sport == 'tennis'}selected{/if}>Tennis</option>
    <option value="basket" {if $sport == 'basket'}selected{/if}>Basket</option>
    <option value="padel" {if $sport == 'padel'}selected{/if}>Padel</option>
</select>