<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Corsi</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
    <div class="form-wrapper">
        <h2>Ricerca Corsi</h2>
        <form method="get" action="/course/showCourses">
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" id="title" name="title" placeholder="Titolo corso">
            </div>
            <div class="form-group">
                <label for="startDate">Data inizio</label>
                <input type="date" id="startDate" name="startDate">
            </div>
            <div class="form-group">
                <label>Giorni della settimana</label>
                {assign var=weekdays value=["Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"]}
                {foreach from=$weekdays item=day}
                    <label style="margin-right:1em;">
                        <input type="checkbox" name="daysOfWeek[]" value="{$day}">
                        {$day}
                    </label>
                {/foreach}
            </div>
            <button type="submit" class="submit-button">Cerca</button>
        </form>
    </div>
</body>
</html>