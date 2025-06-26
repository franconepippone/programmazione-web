<style>
    body {
        background: linear-gradient(120deg, #f1f5f9, #e2e8f0);
        font-family: "Segoe UI", sans-serif;
    }

    .form-wrapper {
        max-width: 720px;
        margin: 3rem auto;
        background: #ffffff;
        padding: 3rem 2.5rem;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .form-wrapper h2 {
        text-align: center;
        font-size: 2rem;
        color: #2c3e50;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.8rem;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #34495e;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    select {
        width: 100%;
        padding: 0.65rem 0.9rem;
        font-size: 1rem;
        border: 1px solid #ced4da;
        border-radius: 10px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    input:focus,
    select:focus {
        border-color: #4dabf7;
        background-color: #ffffff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.2);
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
        padding-top: 0.5rem;
    }

    .checkbox-group label {
        font-weight: 500;
        font-size: 0.95rem;
        color: #495057;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .submit-button {
        display: block;
        width: 100%;
        padding: 0.9rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #4dabf7, #228be6);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(77, 171, 247, 0.4);
        transition: background 0.3s ease;
    }

    .submit-button:hover {
        background: linear-gradient(135deg, #228be6, #1c7ed6);
    }
</style>

<div class="form-wrapper">
    <h2>📘 Crea un nuovo corso</h2>

    <form method="post" action="/employee/courseSummary">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" name="title" id="title" value="{$title|default:''}">
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
            <input type="text" name="description" id="description" value="{$description|default:''}">
        </div>
        <div class="form-group">
            <label for="start_date">Data inizio</label>
            <input type="date" name="start_date" id="start_date" value="{$start_date|default:''}">
        </div>
        <div class="form-group">
            <label for="start_time">Orario inizio</label>
            <input type="time" name="start_time" id="start_time" value="{$start_time|default:''}">
        </div>
        <div class="form-group">
            <label for="end_time">Orario fine</label>
            <input type="time" name="end_time" id="end_time" value="{$end_time|default:''}">
        </div>
        <div class="form-group">
            <label for="cost">Costo iscrizione</label>
            <input type="text" name="cost" id="cost" value="{$cost|default:''}">
        </div>
        <div class="form-group">
            <label for="max_participants">Numero massimo partecipanti</label>
            <input type="number" name="max_participants" id="max_participants" value="{$max_participants|default:''}">
        </div>
        <div class="form-group">
            <label>Giorni della settimana</label>
            <div class="checkbox-group">
                {foreach from=['Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato','Domenica'] item=day}
                    <label>
                        <input type="checkbox" name="days[]" value="{$day}"
                            {if isset($days) && $day|in_array:$days}checked{/if}>
                        {$day}
                    </label>
                {/foreach}
            </div>
        </div>
        <div class="form-group">
            <label for="instructor">Istruttore</label>
            <select name="instructor" id="instructor">
                <option value="">Seleziona...</option>
                {foreach from=$instructors item=inst}
                    <option value="{$inst.id}" {if $inst.id == ($instructor|default:'')}selected{/if}>
                        {$inst.name} {$inst.surname}
                    </option>
                {/foreach}
            </select>
        </div>
        <div class="form-group">
            <label for="field">Campo</label>
            <select name="field" id="field">
                <option value="">Seleziona...</option>
                {foreach from=$fields item=field}
                    <option value="{$field.id}" {if $field.id == ($field|default:'')}selected{/if}>
                        {$field.name}
                    </option>
                {/foreach}
            </select>
        </div>
        <button class="submit-button" type="submit">Continua</button>
    </form>
</div>
