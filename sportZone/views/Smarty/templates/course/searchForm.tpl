<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Corsi Sportivi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 500px; margin: auto; }
        label { display: block; margin-top: 15px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; }
    </style>
</head>
<body>
    <h1>Ricerca Corsi Sportivi</h1>
    <form method="post" action="/course/showCourses">
        <label for="title">Titolo:</label>
        <input type="text" id="title" name="title" placeholder="Titolo corso">

        <label for="startDate">Data di inizio:</label>
        <input type="date" id="startDate" name="startDate">

        <label for="endDate">Data di fine:</label>
        <input type="date" id="endDate" name="endDate">

        <label for="description">Descrizione:</label>
        <input type="text" id="description" name="description" placeholder="Descrizione">

        <label for="timeSlot">Fascia oraria (es. 09:00-11:00):</label>
        <input type="text" id="timeSlot" name="timeSlot" pattern="^\d{2}:\d{2}-\d{2}:\d{2}$" placeholder="HH:MM-HH:MM">

        <label for="cost">Costo massimo (€):</label>
        <input type="number" id="cost" name="cost" min="0" step="0.01" placeholder="Es. 100.00">

        <label for="MaxParticipantsCount">Numero massimo partecipanti:</label>
        <input type="number" id="MaxParticipantsCount" name="MaxParticipantsCount" min="1" placeholder="Es. 20">

        <button type="submit">Cerca</button>
    </form>
</body>
</html>