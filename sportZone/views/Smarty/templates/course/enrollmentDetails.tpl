<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo di iscrizione - Riepilogo</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/details.css">
</head>
<body>
    <div class="details-container">
        <h2 class="details-title">Modulo di iscrizione</h2>
        <p>Corso: <strong>{$course.title|escape}</strong></p>
        <div class="details-list">
            <div class="details-row">
                <span class="details-label" name="name">Nome:</span>
                <span class="details-value">{$user.name|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="surname">Cognome:</span>
                <span class="details-value">{$user.surname|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="birthDate">Data di nascita:</span>
                <span class="details-value">{$user.birthDate|date_format:"%d/%m/%Y"}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="sex">Sesso:</span>
                <span class="details-value">{$user.sex|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="email">Email:</span>
                <span class="details-value">{$user.email|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="username">Username:</span>
                <span class="details-value">{$user.username|escape}</span>
            </div>
        </div>
        <div class="details-actions">
            <a href="/course/enrollForm/{$course.id}" class="action-btn back-btn">Modifica dati</a>
            <a href="/course/confirmEnrollment/{$course.id}" class="action-btn">Conferma iscrizione</a>
        </div>
    </div>
</body>
</html>