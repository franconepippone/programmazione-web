<!DOCTYPE html> 
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo di iscrizione - Riepilogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <h2 class="mb-4">Modulo di iscrizione</h2>
        <p>Corso: <strong>{$course.title|escape}</strong></p>

        <dl class="row mb-4">
            <dt class="col-sm-3">Nome:</dt>
            <dd class="col-sm-9">{$user.name|escape}</dd>

            <dt class="col-sm-3">Cognome:</dt>
            <dd class="col-sm-9">{$user.surname|escape}</dd>

            <dt class="col-sm-3">Data di nascita:</dt>
            <dd class="col-sm-9">{$user.birthDate|date_format:"%d/%m/%Y"}</dd>

            <dt class="col-sm-3">Sesso:</dt>
            <dd class="col-sm-9">{$user.sex|escape}</dd>

            <dt class="col-sm-3">Email:</dt>
            <dd class="col-sm-9">{$user.email|escape}</dd>

            <dt class="col-sm-3">Username:</dt>
            <dd class="col-sm-9">{$user.username|escape}</dd>
        </dl>

        <div class="d-flex gap-3">
            <a href="/enrollment/enrollForm/{$course.id}" class="btn btn-secondary">Modifica dati</a>
            <a href="/enrollment/finalizeEnrollment/{$course.id}" class="btn btn-primary">Conferma iscrizione</a>
        </div>
    </div>
</body>
</html>
