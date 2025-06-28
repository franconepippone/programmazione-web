<!DOCTYPE html> 
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo di iscrizione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <h2 class="mb-4 text-center">Modulo di iscrizione</h2>
        <p class="text-center mb-4">
            Corso: <strong>{$title|escape}</strong>
        </p>
        <form method="post" action="/course/submitEnrollment" class="mx-auto" style="max-width: 500px;">
            <input type="hidden" name="id" value="{$id}">

            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" id="name" name="name" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Cognome:</label>
                <input type="text" id="surname" name="surname" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="birthDate" class="form-label">Data di nascita:</label>
                <input type="date" id="birthDate" name="birthDate" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="sex" class="form-label">Sesso:</label>
                <select id="sex" name="sex" required class="form-select">
                    <option value="">Seleziona</option>
                    <option value="MALE">Maschio</option>
                    <option value="FEMALE">Femmina</option>
                    <option value="OTHER">Altro</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">Iscriviti</button>
        </form>
    </div>
</body>
</html>
