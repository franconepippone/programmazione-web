<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Corso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
    <div class="container my-4 form-wrapper">
        <h2 class="mb-4">Modifica Corso</h2>
        <form method="post" action="/course/finalizeModifyCourse/{$course.id}">
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" id="title" name="title" value="{$course.title|escape}" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea id="description" name="description" required class="form-control">{$course.description|escape}</textarea>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Data inizio</label>
                <input type="date" id="startDate" name="startDate" value="{$course.startDate|date_format:'%Y-%m-%d'}" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">Data fine</label>
                <input type="date" id="endDate" name="endDate" value="{$course.endDate|date_format:'%Y-%m-%d'}" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="timeSlot" class="form-label">Fascia oraria</label>
                <input type="text" id="timeSlot" name="timeSlot" value="{$course.timeSlot|escape}" required class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Giorni della settimana</label>
                <div>
                    {assign var=weekdays value=["Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"]}
                    {foreach from=$weekdays item=day}
                        <div class="form-check form-check-inline me-3">
                            <input class="form-check-input" type="checkbox" id="day-{$day}" name="daysOfWeek[]" value="{$day}"
                                {if $course.daysOfWeek && $day|in_array:$course.daysOfWeek}checked{/if}>
                            <label class="form-check-label" for="day-{$day}">{$day}</label>
                        </div>
                    {/foreach}
                </div>
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label">Costo (€)</label>
                <input type="number" id="cost" name="cost" step="0.01" min="0" value="{$course.cost|escape}" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="MaxParticipantsCount" class="form-label">Numero massimo partecipanti</label>
                <input type="number" id="MaxParticipantsCount" name="MaxParticipantsCount" min="1" value="{$course.MaxParticipantsCount|escape}" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="field" class="form-label">Campo</label>
                <input type="text" id="field" name="field" value="{$course.field|escape}" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="instructor" class="form-label">Istruttore</label>
                <input type="text" id="instructor" value="{$course.instructor|escape}" disabled class="form-control">
                <input type="hidden" name="instructor" value="{$course.instructor|escape}">
            </div>
            <button type="submit" class="btn btn-primary submit-button">Salva modifiche</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
