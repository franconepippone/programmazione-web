{extends file=$layout}
{assign var="page_title" value="Successo"}

{block name="styles"}
    <style>
        .centered-success-wrapper {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .simple-success-box {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 2rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(6, 95, 70, 0.08);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .simple-success-box h1 {
            margin: 0 0 1rem 0;
            font-size: 2rem;
        }
        .simple-success-box p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .simple-success-box button {
            background: #10b981;
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        .simple-success-box button:hover {
            background: #059669;
        }
    </style>
{/block}

{block name="content"}
    <div class="centered-success-wrapper">
        <div class="simple-success-box">
            <h1>Successo</h1>
            <p>{$success_message|escape}</p>
            <button type="button" onclick="history.back()">Continua</button>
        </div>
    </div>
{/block}
