<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Corso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/details.css">
    <!-- Per stili specifici di entità, aggiungi un altro CSS, es: -->
    <!-- <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/results.css"> -->
</head>
<body>
    <div class="container my-4 details-container">
        <h2 class="details-title mb-4">Dettagli Corso</h2>
        {foreach from=$courses item=course}
        <div class="details-list mb-4">
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="id">ID:</div>
                <div class="col-8 details-value">{$course.id|default:'N/D'}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="title">Titolo:</div>
                <div class="col-8 details-value">{$course.title|default:'N/D'|escape}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="description">Descrizione:</div>
                <div class="col-8 details-value">{$course.description|default:'N/D'|escape}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="startDate">Data inizio:</div>
                <div class="col-8 details-value">
                    {if $course.startDate}
                        {$course.startDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="endDate">Data fine:</div>
                <div class="col-8 details-value">
                    {if $course.endDate}
                        {$course.endDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="timeSlot">Fascia oraria:</div>
                <div class="col-8 details-value">{$course.timeSlot|default:'N/D'}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="daysOfWeek">Giorni:</div>
                <div class="col-8 details-value">
                    {if $course.daysOfWeek|@count > 0}
                        {foreach from=$course.daysOfWeek item=day name=giorni}
                            {$day}{if !$smarty.foreach.giorni.last}, {/if}
                        {/foreach}
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="cost">Costo:</div>
                <div class="col-8 details-value">
                    {if $course.cost !== null && $course.cost !== ''}
                        {$course.cost} €
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="MaxParticipantsCount">Max partecipanti:</div>
                <div class="col-8 details-value">{$course.MaxParticipantsCount|default:'N/D'}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="field">Campo:</div>
                <div class="col-8 details-value">{$course.field|default:'N/D'}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold details-label" name="instructor">Istruttore:</div>
                <div class="col-8 details-value">{$course.instructor|default:'N/D'}</div>
            </div>
        </div>
        <div class="details-actions d-flex justify-content-between align-items-center">
            <a href="javascript:history.back()" class="btn btn-outline-primary action-btn back-btn">⬅ Torna indietro</a>
        </div>
        {/foreach}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
