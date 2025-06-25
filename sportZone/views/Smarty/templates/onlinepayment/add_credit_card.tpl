{* filepath: sportZone/templates/credit_card/new.tpl *}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Credit Card</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
            padding: 0;
        }
        .card-form-container {
            background: #fff;
            max-width: 400px;
            margin: 40px auto;
            padding: 32px 28px 24px 28px;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px; /* top right bottom left */
        }
        .card-form-container h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #2d3a4b;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #3a4a5d;
            font-weight: 500;
        }
        input, select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            font-size: 1rem;
            background: #f9fafb;
            transition: border-color 0.2s;
            margin-left: 0;
            margin-right: 0;    
        }
        input:focus, select:focus {
            border-color: #4f8cff;
            outline: none;
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #4f8cff;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .submit-btn:hover {
            background: #346fd1;
        }
    </style>
</head>
<body>
    <div class="card-form-container">
        <h2>Add Credit Card</h2>
        <form method="post" action="/onlinePayment/finalizeAddCreditCard">
            <div class="form-group">
                <label for="number">Card Number</label>
                {literal}
                <input type="text" id="number" name="number" maxlength="20" required pattern="[0-9 ]{13,19}" placeholder="1234 5678 9012 3456">
                 
            </div>
            
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" maxlength="4" required pattern="[0-9]{3,4}" placeholder="CVV">
                {/literal}
            </div>
            
            <div class="form-group">
                <label for="expirationDate">Expiration Date</label>
                <input type="month" id="expirationDate" name="expirationDate" required min="2024-06">
            </div>
            <div class="form-group">
                <label for="cardNetwork">Card Network</label>
                <select id="cardNetwork" name="cardNetwork" required>
                    <option value="">Select network</option>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="American Express">American Express</option>
                    <option value="Discover">Discover</option>
                    <option value="Maestro">Maestro</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bank">Bank</label>
                <input type="text" id="bank" name="bank" maxlength="50" required placeholder="Bank name">
            </div>
            <div class="form-group">
                <label for="owner">Card Owner</label>
                <input type="text" id="owner" name="owner" maxlength="100" required placeholder="Owner's full name">
            </div>
            <button type="submit" class="submit-btn">Add Card</button>
        </form>
    </div>