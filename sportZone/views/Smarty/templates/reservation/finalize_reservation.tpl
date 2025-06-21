<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Finalize Reservation</title>
</head>
<body>

<h2>Finalize your reservation</h2>

<p><strong>Field:</strong> {$field.name}</p>
<p><strong>Date:</strong> {$date}</p>
<p><strong>Time:</strong> {$time}</p>

<form action="finalizeReservation.php" method="post">
    <input type="hidden" name="field_id" value="{$field.id}">
    <input type="hidden" name="date" value="{$date}">
    <input type="hidden" name="time" value="{$time}">

    <p>Please select the payment method:</p>

    <label>
        <input type="radio" name="payment_method" value="online" required>
        Online Payment
    </label>
    <br>
    <label>
        <input type="radio" name="payment_method" value="onsite" required>
        On-site Payment
    </label>

    <br><br>

    <button type="submit">Confirm Reservation</button>
</form>

</body>
</html>
