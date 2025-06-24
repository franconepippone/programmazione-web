<style>
    .summary-wrapper {
        max-width: 700px;
        margin: 3rem auto;
        padding: 2rem;
        background-color: #fefefe;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        font-family: "Segoe UI", sans-serif;
    }

    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .summary-item {
        margin-bottom: 1rem;
        padding: 0.5rem 1rem;
        border-left: 5px solid #4dabf7;
        background-color: #f1f5f9;
        border-radius: 8px;
    }

    .label {
        font-weight: bold;
        color: #2c3e50;
    }

    .value {
        margin-left: 0.5rem;
        color: #555;
    }

    .confirm-button {
        display: block;
        margin: 2rem auto 0;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        color: white;
        background-color: #38b000;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .confirm-button:hover {
        background-color: #2a8700;
    }
<div class="summary-wrapper">
    <h2>📋 Riepilogo del corso</h2>

    <div class="summary-item"><span class="label">Titolo:</span><span class="value">{$title|escape}</span></div>
    <div class="summary-item"><span class="label">Descrizione:</span><span class="value">{$description|escape}</span></div>
    <div class="summary-item"><span class="label">Data inizio:</span><span class="value">{$start_date}</span></div>
    <div class="summary-item"><span class="label">Orario:</span><span class="value">{$start_time} - {$end_time}</span></div>
    <div class="summary-item"><span class="label">Giorni:</span><span class="value">{$days_string|escape}</span></div>
    <div class="summary-item"><span class="label">Istruttore:</span><span class="value">{$instructor->getFullName()|escape}</span></div>
    <div class="summary-item"><span class="label">Campo:</span><span class="value">{$field->getSport()|escape}</span></div>
    <div class="summary-item"><span class="label">Costo iscrizione:</span><span class="value">{$cost} €</span></div>
    <div class="summary-item"><span class="label">Numero massimo partecipanti:</span><span class="value">{$max_participants}</span></div>

    <form method="post" action="/employee/finalizeCreateCourse">
        <button class="confirm-button">✅ Conferma Creazione</button>
    </form>
</div>
