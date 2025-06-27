<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Le mie iscrizioni</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/results.css">
</head>
<body>
    <div class="results-list">
        <h2>Le mie iscrizioni</h2>
        {if $enrollments|@count > 0}
            {foreach from=$enrollments item=enrollment}
                <div class="result-card">
                    <input type="hidden" name="id" value="{$enrollment.id}">
                    <div class="result-info">
                        <div class="result-title" name="title">
                            {$enrollment.course['title']|escape}
                        </div>
                        <div class="result-date" name="enrollmentDate">
                            Iscritto il: {$enrollment.enrollmentDate|date_format:"%d/%m/%Y"}
                        </div>
                        <div class="result-description" name="description">
                            {$enrollment.course['description']|escape}
                        </div>
                        <div class="result-client" name="client">
                            Utente: 
                            {if $enrollment.client && $enrollment.client[0]}
                                {$enrollment.client[0]['name']|escape} {$enrollment.client[0]['surname']|escape}
                            {/if}
                        </div>
                    </div>
                    <a class="details-btn" href="/course/courseDetails/{$enrollment.course['id']}">Dettagli corso</a>
                </div>
            {/foreach}
        {else}
            <p>Non hai ancora effettuato iscrizioni a corsi.</p>
        {/if}
    </div>
</body>
</html>