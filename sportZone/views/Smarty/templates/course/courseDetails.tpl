<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Corso</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/details.css">
    <!-- Per stili specifici di entità, aggiungi un altro CSS, es: -->
    <!-- <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/results.css"> -->
</head>
<body>
    <div class="details-container">
        <h2 class="details-title">Dettagli Corso</h2>
        <div class="details-list">
            <div class="details-row">
                <span class="details-label" name="id">ID:</span>
                <span class="details-value">{$course->getId()}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="title">Titolo:</span>
                <span class="details-value">{$course->getTitle()|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="description">Descrizione:</span>
                <span class="details-value">{$course->getDescription()|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="startDate">Data inizio:</span>
                <span class="details-value">{$course->getStartDate()|date_format:"%d/%m/%Y"}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="endDate">Data fine:</span>
                <span class="details-value">{$course->getEndDate()|date_format:"%d/%m/%Y"}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="timeSlot">Fascia oraria:</span>
                <span class="details-value">{$course->getTimeSlot()}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="daysOfWeek">Giorni:</span>
                <span class="details-value">
                    {foreach from=$course->getDaysOfWeek() item=day}
                        {$day}{if !$smarty.foreach.days.last}, {/if}
                    {/foreach}
                </span>
            </div>
            <div class="details-row">
                <span class="details-label" name="cost">Costo:</span>
                <span class="details-value">{$course->getEnrollmentCost()} €</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="MaxParticipantsCount">Max partecipanti:</span>
                <span class="details-value">{$course->getMaxParticipantsCount()}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="field">Campo:</span>
                <span class="details-value">{$course->getField()->getName()}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="instructor">Istruttore:</span>
                <span class="details-value">
                    {if $course->getInstructor()}
                        {$course->getInstructor()->getName()}
                    {else}
                        Non assegnato
                    {/if}
                </span>
            </div>
        </div>
        <div class="details-actions">
            <a href="/course/enrollForm/{$course->getId()}" class="action-btn">Iscriviti al corso</a>
            <a href="/course/showCourses" class="action-btn back-btn">Torna ai risultati</a>
        </div>
    </div>
</body>
</html>