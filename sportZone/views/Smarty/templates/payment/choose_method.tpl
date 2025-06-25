<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Payment Method</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
        }
        .payment-methods-container {
            max-width: 400px;
            margin: 40px auto;
            background: #fff;
            padding: 32px 28px 24px 28px;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        .payment-method-form {
            display: flex;
            align-items: center;
            border: 2px solid #4f8cff;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 18px;
            background: #f9fafb;
            transition: box-shadow 0.2s, border-color 0.2s;
            box-shadow: 0 2px 8px rgba(79,140,255,0.08);
        }
        .payment-method-form:hover {
            border-color: #346fd1;
            box-shadow: 0 4px 16px rgba(79,140,255,0.15);
        }
        .payment-method-btn {
            padding: 8px 14px;
            background: #4f8cff;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-right: 18px;
            transition: background 0.2s;
            min-width: 90px;
        }
        .payment-method-btn:hover {
            background: #346fd1;
        }
        .method-details {
            flex: 1;
            font-size: 1rem;
            color: #3a4a5d;
        }
        .separator {
            display: flex;
            align-items: center;
            margin: 18px 0;
        }
        .separator hr {
            flex: 1;
            border: none;
            border-top: 1.5px solid #cfd8dc;
        }
        .separator span {
            padding: 0 12px;
            color: #888;
            font-size: 0.97rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="payment-methods-container">
        <h2>Choose a Payment Method</h2>
        <h3>Payment amount: {$amount}€</h3>
        {if $paymentMethods|@count > 0}
            {* First payment method *}
            <form class="payment-method-form" method="post" action="/payment/confirmPay">
                <input type="hidden" name="methodId" value="{$paymentMethods[0].id}">
                <button type="submit" class="payment-method-btn">
                    Select
                </button>

                <strong> Pay onsite </strong>
            </form>
        {/if}
        {if $paymentMethods|@count > 1}
            <div class="separator">
                <hr>
                <span>or pay online using:</span>
                <hr>
            </div>
            {section name=idx loop=$paymentMethods start=1}
                <form class="payment-method-form" method="post" action="/payment/confirmPay">
                    <input type="hidden" name="methodId" value="{$paymentMethods[idx].id}">
                    <button type="submit" class="payment-method-btn">
                        Select
                    </button>
                    <div class="method-details">
                        {if $paymentMethods[idx].type == "online"}
                            <strong>Card Number:</strong> {$paymentMethods[idx].number}<br>
                            <strong>Owner:</strong> {$paymentMethods[idx].owner}<br>
                            <strong>Bank:</strong> {$paymentMethods[idx].bank}<br>
                            <strong>Network:</strong> {$paymentMethods[idx].cardNetwork}<br>
                        {/if}
                    </div>
                </form>
            {/section}
        {/if}
    </div>
</body>
</html>