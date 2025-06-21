<h2>Reservation Summary</h2>

{if $field}
    <p>Field Sport: {$field->getSport()}</p>
    <p>Field Type: {$field->getType()}</p>
{else}
    <p><em>Field data not available (null object)</em></p>
{/if}

<p>Date: {$date|default:'N/A'}</p>
<p>Time: {$time|default:'N/A'}</p>

{if !$paymentMethod}
    <form method="post" action="{$baseUrl}/reservation/finalizeReservation">
        <input type="hidden" name="field_id" value="{$field ? $field->getId() : ''}">
        <input type="hidden" name="date" value="{$date|default:''}">
        <input type="hidden" name="time" value="{$time|default:''}">

        <label for="paymentMethod">Choose payment method:</label>
        <select name="paymentMethod" id="paymentMethod">
            <option value="">--Select--</option>
            <option value="onsite">Onsite Payment</option>
            <option value="online">Online Payment</option>
        </select>

        <button type="submit">Confirm</button>
    </form>
{/if}
