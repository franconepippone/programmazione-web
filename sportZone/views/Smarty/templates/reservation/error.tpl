<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Errore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da;
            color: #721c24;
            padding: 20px;
        }
        h1 {
            color: #721c24;
        }
        a {
            color: #721c24;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Errore</h1>
    <p>{$error_message|escape}</p>
    <a href="javascript:history.back()">Torna indietro</a>
</body>
</html>
