{extends file=$layout}
{assign var="page_title" value="Errore"}

{block name="styles"}
    <style>
        .centered-error-wrapper {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .simple-error-box {
            background: #fff3f3;
            border: 1px solid #f5c6cb;
            color: #b71c1c;
            padding: 2rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(183,28,28,0.08);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .simple-error-box h1 {
            margin: 0 0 1rem 0;
            font-size: 2rem;
        }
        .simple-error-box p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .simple-error-box button {
            background: #b71c1c;
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        .simple-error-box button:hover {
            background: #8a1414;
        }
    </style>
{/block}

{block name="content"}
    <div class="centered-error-wrapper">
        <div class="simple-error-box">
            <h1>Errore</h1>
            <p>{$error_message|escape}</p>
            <button type="button" onclick="history.back()">Torna indietro</button>
        </div>
    </div>
{/block}