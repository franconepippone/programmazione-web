{extends file=$layout}
{assign var="page_title" value=$status|default:"info"}

{block name="style"}
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff3f3;
            color: #b71c1c;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .error-container {
            color: #b71c1c;
            background-color: #fce4e4;
            background-color: #fff3f3;
            border: 1px solid #f5c6cb;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(183, 28, 28, 0.2);
            max-width: 400px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        button {
            background-color: #b71c1c;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #8a1414;
        }
    </style>
{/block}

{block name="content"}
    
        <div class="error-container">
        <h1>Successo!</h1>
        <p>{$success_message|escape}</p>
        <button type="button" onclick="history.back()">Torna indietro</button>
    </div>
{/block}