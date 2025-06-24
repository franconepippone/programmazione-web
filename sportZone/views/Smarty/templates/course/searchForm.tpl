<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Corsi Sportivi</title>
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
</head>
<body>
    <div class="form-wrapper" id="search-course-form-wrapper">
        <h2>Ricerca Corsi Sportivi</h2>
        <form method="post" action="/course/showCourses" id="search-course-form">
            <div class="form-group">
                <label for="title">Titolo:</label>
                <input type="text" id="title" name="title" class="input-text" placeholder="Titolo corso">
            </div>

            <div class="form-group">
                <label for="startDate">Data di inizio:</label>
                <input type="date" id="startDate" name="startDate" class="input-date">
            </div>

            <div class="form-group">
                <label for="endDate">Data di fine:</label>
                <input type="date" id="endDate" name="endDate" class="input-date">
            </div>

            <div class="form-group">
                <label for="description">Descrizione:</label>
                <input type="text" id="description" name="description" class="input-text" placeholder="Descrizione">
            </div>

            <div class="form-group">
                <label for="timeSlot">Fascia oraria (es. 09:00-11:00):</label>
                <input type="text" id="timeSlot" name="timeSlot" class="input-text" pattern="^\d{2}:\d{2}-\d{2}:\d{2}$" placeholder="HH:MM-HH:MM">
            </div>

            <div class="form-group">
                <label for="cost">Costo massimo (€):</label>
                <input type="number" id="cost" name="cost" class="input-number" min="0" step="0.01" placeholder="Es. 100.00">
            </div>

            <div class="form-group">
                <label for="MaxParticipantsCount">Numero massimo partecipanti:</label>
                <input type="number" id="MaxParticipantsCount" name="MaxParticipantsCount" class="input-number" min="1" placeholder="Es. 20">
            </div>

            <button type="submit" class="submit-button" id="search-course-submit">Cerca</button>
        </form>
    </div>
</body>
</html>