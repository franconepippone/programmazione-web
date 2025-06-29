{if isset($search)}
    {assign var="sport" value=$search.sport}
{else}
    {assign var="sport" value=""}
{/if}

<label for="sport" class="form-label">Sport:</label>
<select name="sport" id="sport" class="form-select">
    {if not $Mandatory}
        <option value="">-- Tutti gli sport --</option>
    {/if}
    <option value="football" {if $sport == 'football' || ($Mandatory && $sport == '')}selected{/if}>Calcio</option>
    <option value="tennis" {if $sport == 'tennis'}selected{/if}>Tennis</option>
    <option value="basket" {if $sport == 'basket'}selected{/if}>Basket</option>
    <option value="padel" {if $sport == 'padel'}selected{/if}>Padel</option>
</select>