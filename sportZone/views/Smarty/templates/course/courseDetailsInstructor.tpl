<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Corso</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/details.css">
</head>
<body>
    <div class="details-container">
        <h2 class="details-title">Dettagli Corso</h2>
        {foreach from=$courses item=course}
        <div class="details-list">
            <div class="details-row">
                <span class="details-label" name="id">ID:</span>
                <span class="details-value">{$course.id|default:'N/D'}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="title">Titolo:</span>
                <span class="details-value">{$course.title|default:'N/D'|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="description">Descrizione:</span>
                <span class="details-value">{$course.description|default:'N/D'|escape}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="startDate">Data inizio:</span>
                <span class="details-value">
                    {if $course.startDate}
                        {$course.startDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </span>
            </div>
            <div class="details-row">
                <span class="details-label" name="endDate">Data fine:</span>
                <span class="details-value">
                    {if $course.endDate}
                        {$course.endDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </span>
            </div>
            <div class="details-row">
                <span class="details-label" name="timeSlot">Fascia oraria:</span>
                <span class="details-value">{$course.timeSlot|default:'N/D'}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="daysOfWeek">Giorni:</span>
                <span class="details-value">
                    {if $course.daysOfWeek|@count > 0}
                        {foreach from=$course.daysOfWeek item=day name=giorni}
                            {$day}{if !$smarty.foreach.giorni.last}, {/if}
                        {/foreach}
                    {else}
                        N/D
                    {/if}
                </span>
            </div>
            <div class="details-row">
                <span class="details-label" name="cost">Costo:</span>
                <span class="details-value">
                    {if $course.cost !== null && $course.cost !== ''}
                        {$course.cost} €
                    {else}
                        N/D
                    {/if}
                </span>
            </div>
            <div class="details-row">
                <span class="details-label" name="MaxParticipantsCount">Max partecipanti:</span>
                <span class="details-value">{$course.MaxParticipantsCount|default:'N/D'}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="field">Campo:</span>
                <span class="details-value">{$course.field|default:'N/D'}</span>
            </div>
            <div class="details-row">
                <span class="details-label" name="instructor">Istruttore:</span>
                <span class="details-value">{$course.instructor|default:'N/D'}</span>
            </div>
        </div>
        {/foreach}

        <div class="details-list" style="margin-top:2em;">
            <h3>Iscritti al corso</h3>
            {if $enrollments|@count > 0}
                <ul>
                    {foreach from=$enrollments item=enrollment}
                        <li>
                            {if isset($enrollment.name) || isset($enrollment.surname)}
                                {if isset($enrollment.name)}{$enrollment.name|escape}{/if}
                                {if isset($enrollment.surname)} {$enrollment.surname|escape}{/if}
                            {else}
                                {$enrollment|escape}
                            {/if}
                        </li>
                    {/foreach}
                </ul>
            {else}
                <p>Nessun iscritto al momento.</p>
            {/if}
        </div>
        <div class="details-actions" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="javascript:history.back()" class="action-btn back-btn">⬅ Torna indietro</a>
        </div>
    </div>
</body>
</html>