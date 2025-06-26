{* filepath: payment/confirm.tpl *}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Payment</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
        }
        .confirmation-container {
            max-width: 420px;
            margin: 50px auto;
            background: #fff;
            padding: 36px 32px 28px 32px;
            border-radius: 14px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.10);
        }
        .confirmation-title {
            text-align: center;
            font-size: 1.5rem;
            color: #2d3a4b;
            margin-bottom: 18px;
        }
        .payment-summary {
            background: #eaf1ff;
            border: 2px solid #4f8cff;
            border-radius: 10px;
            padding: 24px 18px;
            margin-bottom: 24px;
            font-size: 1.1rem;
            color: #2d3a4b;
        }
        .summary-row {
            margin-bottom: 10px;
        }
        .summary-label {
            font-weight: bold;
            margin-right: 8px;
        }
        .confirm-btn {
            width: 100%;
            padding: 14px;
            background: #4f8cff;
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: 1.15rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .confirm-btn:hover {
            background: #346fd1;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="confirmation-title">Confirm Your Payment</div>
        <div class="payment-summary">
            <div class="summary-row">
                <span class="summary-label">Amount:</span>
                <span>{$amount}&euro;</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Payment Method:</span>
                <span>
                    {if $method.cardNetwork}
                        {$method.cardNetwork} - 
                    {/if}
                    {if $method.number}
                        **** **** **** {$method.number|substr:-4}
                    {/if}
                    {if $method.owner}
                        &nbsp;({$method.owner})
                    {/if}
                </span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Destination:</span>
                <span>{$redirect|escape}</span>
            </div>
        </div>
        <form method="post" action="/payment/confirmPay">
            <input type="hidden" name="methodId" value="{$method.id}">
            <button type="submit" class="confirm-btn">Confirm and Pay</button>
        </form>
    </div>
</body>
</html>