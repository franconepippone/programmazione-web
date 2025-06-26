<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Corso</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
    <div class="form-wrapper">
        <h2>Modifica Corso</h2>
        <form method="post" action="/course/finalizeModifyCourse/{$course.id}">
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" id="title" name="title" value="{$course.title|escape}" required>
            </div>
            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea id="description" name="description" required>{$course.description|escape}</textarea>
            </div>
            <div class="form-group">
                <label for="startDate">Data inizio</label>
                <input type="date" id="startDate" name="startDate" value="{$course.startDate|date_format:'%Y-%m-%d'}" required>
            </div>
            <div class="form-group">
                <label for="endDate">Data fine</label>
                <input type="date" id="endDate" name="endDate" value="{$course.endDate|date_format:'%Y-%m-%d'}" required>
            </div>
            <div class="form-group">
                <label for="timeSlot">Fascia oraria</label>
                <input type="text" id="timeSlot" name="timeSlot" value="{$course.timeSlot|escape}" required>
            </div>
            <div class="form-group">
                <label>Giorni della settimana</label>
                {assign var=weekdays value=["Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"]}
                {foreach from=$weekdays item=day}
                    <label style="margin-right:1em;">
                        <input type="checkbox" name="daysOfWeek[]" value="{$day}"
                            {if $course.daysOfWeek && $day|in_array:$course.daysOfWeek}checked{/if}>
                        {$day}
                    </label>
                {/foreach}
            </div>
            <div class="form-group">
                <label for="cost">Costo (€)</label>
                <input type="number" id="cost" name="cost" step="0.01" min="0" value="{$course.cost|escape}" required>
            </div>
            <div class="form-group">
                <label for="MaxParticipantsCount">Numero massimo partecipanti</label>
                <input type="number" id="MaxParticipantsCount" name="MaxParticipantsCount" min="1" value="{$course.MaxParticipantsCount|escape}" required>
            </div>
            <div class="form-group">
                <label for="field">Campo</label>
                <input type="text" id="field" name="field" value="{$course.field|escape}" required>
            </div>
            <div class="form-group">
                <label for="instructor">Istruttore</label>
                <input type="text" id="instructor" name="instructor" value="{$course.instructor|escape}" required>
            </div>
            <button type="submit" class="submit-button">Salva modifiche</button>
        </form>
    </div>
</body>