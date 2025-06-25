<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Crea un nuovo corso</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
<div class="form-wrapper">
    <h2>📘 Crea un nuovo corso</h2>

    <form method="post" action="/employee/finalizeCreateCourse">

        <div class="form-group">
            <label for="title">📛 Titolo del corso</label>
            <input type="text" name="title" id="title" value="{$course.title|default:''}" required>
        </div>

        <div class="form-group">
            <label for="description">📝 Descrizione del corso</label>
            <textarea name="description" id="description" rows="4" required>{$course.description|default:''|escape}</textarea>
        </div>

        <div class="form-group">
            <label for="startDate">📅 Data di inizio</label>
            <input type="date" name="startDate" id="startDate" value="{$course.startDate|default:''}" required>
        </div>

        <div class="form-group">
            <label for="endDate">📅 Data di fine</label>
            <input type="date" name="endDate" id="endDate" value="{$course.endDate|default:''}" required>
        </div>

        <div class="form-group">
            <label for="timeSlot">🕒 Fascia oraria (es: 09:00-11:00)</label>
            <input type="text" name="timeSlot" id="timeSlot" value="{$course.timeSlot|default:''}" required>
        </div>

        <div class="form-group">
            <label>📆 Giorni della settimana</label>
            <div class="checkbox-group">
                {assign var=weekdays value=["Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"]}
                {foreach from=$weekdays item=day}
                    <label>
                        <input type="checkbox" name="daysOfWeek[]" value="{$day}" {if $course.daysOfWeek && in_array($day, $course.daysOfWeek)}checked{/if}>
                        {$day}
                    </label>
                {/foreach}
            </div>
        </div>

        <div class="form-group">
            <label for="instructor">👤 Istruttore</label>
            <select name="instructor" id="instructor" required>
                <option value="">-- Seleziona --</option>
                {foreach from=$instructors item=i}
                    <option value="{$i.id}" {if $course.instructor == $i.id}selected{/if}>
                        {$i.name} {$i.surname}
                    </option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="field">🏟️ Campo</label>
            <select name="field" id="field" required>
                <option value="">-- Seleziona --</option>
                {foreach from=$fields item=f}
                    <option value="{$f.id}" {if $course.field == $f.id}selected{/if}>
                        {$f.name}
                    </option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="cost">💰 Costo (€)</label>
            <input type="number" step="0.01" min="0" name="cost" id="cost" value="{$course.cost|default:''}" required>
        </div>

        <div class="form-group">
            <label for="MaxParticipantsCount">👥 Numero massimo partecipanti</label>
            <input type="number" min="1" name="MaxParticipantsCount" id="MaxParticipantsCount" value="{$course.MaxParticipantsCount|default:''}" required>
        </div>

        <button type="submit" class="submit-button">✅ Conferma</button>
    </form>
</div>
</body>
</html>