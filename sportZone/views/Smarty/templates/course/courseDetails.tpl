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
        <div class="details-actions" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="javascript:history.back()" class="action-btn back-btn">⬅ Torna indietro</a>
            
            
            
        </div>
        {/foreach}
    </div>
</body>
</html>
{*
Nota: Per i campi che richiedono formattazione (come date o valuta), viene usato un controllo {if} per evitare errori e mostrare il valore di default ("N/D") se il dato non è disponibile.
Per i campi semplici, il filtro |default:'N/D' è sufficiente.
*}