<h2>Reservation Recap</h2>

<div>
    <p><strong>Field ID:</strong> 
        {if $field}
            {$field->getId()}
        {else}
            $field->getId()
        {/if}
    </p>

    <p><strong>Sport:</strong> 
        {if $field}
            {$field->getSport()}
        {else}
            $field->getSport()
        {/if}
    </p>

    <p><strong>Surface:</strong> 
        {if $field}
            {$field->getSurface()}
        {else}
            $field->getSurface()
        {/if}
    </p>

    <p><strong>Indoor:</strong> 
        {if $field}
            {if $field->isIndoor()} Yes {else} No {/if}
        {else}
            $field->isIndoor()
        {/if}
    </p>

    <p><strong>Hourly Cost:</strong> 
        {if $field}
            {$field->getHourlyCost()} €
        {else}
            $field->getHourlyCost()
        {/if}
    </p>
</div>

<hr>

<div>
    <p><strong>Date:</strong> {$date|default:'(not set)'}</p>
    <p><strong>Time:</strong> {$time|default:'(not set)'}</p>
</div>

<hr>

<form method="post" action="">
    <label for="paymentMethod"><strong>Select payment method:</strong></label><br>
    <select name="paymentMethod" id="paymentMethod" required>
        <option value="">-- Choose --</option>
        <option value="online">Online</option>
        <option value="onsite">Onsite</option>
    </select>

    <br><br>
    <button type="submit">Confirm</button>
</form>
