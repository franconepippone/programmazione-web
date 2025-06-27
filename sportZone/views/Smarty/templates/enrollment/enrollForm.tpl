<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo di iscrizione</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
    <div class="form-wrapper">
        <h2>Modulo di iscrizione</h2>
        <p style="text-align: center; margin-bottom: 2rem;">
            Corso: <strong>{$title|escape}</strong>
        </p>
        <form method="post" action="/course/submitEnrollment">
            <input type="hidden" name="id" value="{$id}">
            
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="surname">Cognome:</label>
                <input type="text" id="surname" name="surname" required>
            </div>

            <div class="form-group">
                <label for="birthDate">Data di nascita:</label>
                <input type="date" id="birthDate" name="birthDate" required>
            </div>

            <div class="form-group">
                <label for="sex">Sesso:</label>
                <select id="sex" name="sex" required>
                    <option value="">Seleziona</option>
                    <option value="MALE">Maschio</option>
                    <option value="FEMALE">Femmina</option>
                    <option value="OTHER">Altro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="submit-button">Iscriviti</button>
        </form>
    </div>
</body>
</html>
