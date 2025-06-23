<html>
<head>
    <title>Pagamento</title>
    <style>
        .payment-box {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h2>Seleziona un metodo di pagamento</h2>

    {if $available_payments.paypal}
    <div class="payment-box" id="paypal-box">
        <h3>PayPal</h3>
        <form action="/payment/paypal_process.php" method="POST">
            <input type="hidden" name="amount" value="{$amount}">
            <button type="submit">Paga con PayPal</button>
        </form>
    </div>
    {/if}

    {if $available_payments.card}
    <div class="payment-box" id="card-box">
        <h3>Carta di Credito</h3>
        <form action="/payment/card_process.php" method="POST">
            <label>Numero Carta:</label><br>
            <input type="text" name="card_number" required><br>
            <label>Scadenza:</label><br>
            <input type="text" name="expiry" required><br>
            <label>CVV:</label><br>
            <input type="text" name="cvv" required><br><br>
            <input type="hidden" name="amount" value="{$amount}">
            <button type="submit">Paga con Carta</button>
        </form>
    </div>
    {/if}
</body>
</html>
