<style>
    .confirmation-wrapper {
        max-width: 600px;
        margin: 4rem auto;
        padding: 2rem;
        background-color: #e6ffed;
        border: 2px solid #38b000;
        border-radius: 12px;
        text-align: center;
        font-family: "Segoe UI", sans-serif;
        color: #2a8700;
        box-shadow: 0 0 15px rgba(56, 176, 0, 0.3);
    }

    h2 {
        margin-bottom: 1.5rem;
    }

    .btn-back {
        margin-top: 2rem;
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: #4dabf7;
        color: white;
        text-decoration: none;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #228be6;
    }
</style>

<div class="confirmation-wrapper">
    <h2>✅ Corso creato con successo!</h2>
    <p>Il nuovo corso è stato aggiunto al database correttamente.</p>
    <a href="/employee/createCourseForm" class="btn-back">🔄 Torna al modulo di creazione corso</a>
</div>
