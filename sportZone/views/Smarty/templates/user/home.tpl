<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef;
            padding: 2rem;
            text-align: center;
        }
        .box {
            background: white;
            padding: 2rem;
            max-width: 500px;
            margin: 3rem auto;
            box-shadow: 0 0 12px rgba(0,0,0,0.15);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Welcome Home</h1>
        <p>Hello, <strong>{$username|escape}</strong>!</p>
        <p>Glad to see you again.</p>
    </div>
</body>
</html>
