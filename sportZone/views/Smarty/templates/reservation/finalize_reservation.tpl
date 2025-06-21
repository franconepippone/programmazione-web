<h2>Reservation Summary</h2>

<p><strong>Field:</strong> 
  {if $field != null}
    {$field->getSport()} - {$field->getType()} - {$field->getCostPerHour()}€/h
  {else}
    {$field->getSport()} - {$field->getType()} - {$field->getCostPerHour()}€/h
  {/if}
</p>

<p><strong>Date:</strong> {$date}</p>
<p><strong>Time:</strong> {$time}</p>

<form method="post" action="">
  <label for="payment_method">Select Payment Method:</label><br>
  <input type="radio" name="payment_method" value="online" required> Online<br>
  <input type="radio" name="payment_method" value="onsite"> Onsite<br><br>
  
  <input type="submit" value="Confirm">
</form>
