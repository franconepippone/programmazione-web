<h2>Reservation Summary</h2>

<p><strong>Field:</strong>
    {if $field !== null}
        {$field->getSport()|escape}
    {else}
        getSport
    {/if}
</p>

<p><strong>Date:</strong> {$date|default:"getDate"}</p>
<p><strong>Time:</strong> {$time|default:"getTime"}</p>

<form method="post" action="">
    <p>
        <label for="payment_method">Select Payment Method:</label><br>
        <select name="payment_method" id="payment_method" required>
            <option value="">-- Select --</option>
            <option value="onsite">Onsite</option>
            <option value="online">Online</option>
        </select>
    </p>
    <button type="submit">Confirm</button>
</form>
