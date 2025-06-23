<style>
    .form-wrapper {
        max-width: 640px;
        margin: 3rem auto;
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', sans-serif;
    }

    .form-wrapper h2 {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 1.8rem;
        color: #343a40;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #495057;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    select {
        width: 100%;
        padding: 0.6rem 0.75rem;
        font-size: 1rem;
        border: 1px solid #ced4da;
        border-radius: 8px;
        background-color: #f8f9fa;
        transition: border-color 0.2s;
    }

    input:focus,
    select:focus {
        border-color: #80bdff;
        outline: none;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 6px;
    }

    .checkbox-group label {
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .submit-button {
        display: block;
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-top: 2rem;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-wrapper">
    <h2>Crea un nuovo corso</h2>

    <form method="post" action="/employee/createCourseForm">

        <div class="form-group">
            <label for="name">Nome del corso</label>
            <input type="text" name="name" id="name" value="{$name|default:''}">
        </div>

        <div class="form-group">
            <label for="start_date">Data di inizio</label>
            <input type="date" name="start_date" id="start_date" value="{$start_date|default:''}">
        </div>

        <div class="form-group">
            <label for="start_time">Orario di inizio</label>
            <input type="time" name="start_time" id="start_time" value="{$start_time|default:''}">
        </div>

        <div class="form-group">
            <label for="end_time">Orario di fine</label>
            <input type="time" name="end_time" id="end_time" value="{$end_time|default:''}">
        </div>

        <div class="form-group">
            <label>Giorni della settimana</label>
            <div class="checkbox-group">
                {assign var=weekdays value=["Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"]}
                {foreach from=$weekdays item=day}
                    <label>
                        <input type="checkbox" name="days[]" value="{$day}" {if $days && in_array($day, $days)}checked{/if}>
                        {$day}
                    </label>
                {/foreach}
            </div>
        </div>

        <div class="form-group">
            <label for="instructor">Istruttore</label>
            <select name="instructor" id="instructor">
                {foreach from=$instructors item=i}
                    <option value="{$i->getId()}" {if $instructor == $i->getId()}selected{/if}>
                        {$i->getFirstName()} {$i->getLastName()}
                    </option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="field">Campo</label>
            <select name="field" id="field">
                {foreach from=$fields item=f}
                    <option value="{$f->getId()}" {if $field == $f->getId()}selected{/if}>
                        {$f->getSport()} - {$f->getType()} ({$f->getCostPerHour()} €/h)
                    </option>
                {/foreach}
            </select>
        </div>

        <button type="submit" class="submit-button">Conferma</button>
    </form>
</div>
