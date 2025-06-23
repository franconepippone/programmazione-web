<style>
    form {
        max-width: 600px;
        margin: auto;
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    label {
        display: block;
        margin-top: 1rem;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 0.5rem;
        margin-top: 0.2rem;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 4px;
        margin-top: 0.5rem;
    }

    button {
        margin-top: 2rem;
        padding: 0.6rem 1.2rem;
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 1rem;
        border-radius: 6px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    h2 {
        text-align: center;
        margin-bottom: 1.5rem;
    }
</style>

<h2>Crea un nuovo corso</h2>

<form method="post" action="/employee/createCourseForm">

    <label for="name">Nome del corso</label>
    <input type="text" name="name" id="name" value="{$name}">

    <label for="start_date">Data di inizio</label>
    <input type="date" name="start_date" id="start_date" value="{$start_date}">

    <label for="start_time">Orario di inizio</label>
    <input type="time" name="start_time" id="start_time" value="{$start_time}">

    <label for="end_time">Orario di fine</label>
    <input type="time" name="end_time" id="end_time" value="{$end_time}">

    <label>Giorni della settimana</label>
    <div class="checkbox-group">
        {assign var=weekdays value=["Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"]}
        {foreach from=$weekdays item=day}
            <label><input type="checkbox" name="days[]" value="{$day}" {if $days && in_array($day, $days)}checked{/if}> {$day}</label>
        {/foreach}
    </div>

    <label for="instructor">Istruttore</label>
    <select name="instructor" id="instructor">
        {foreach from=$instructors item=i}
            <option value="{$i->getId()}" {if $instructor == $i->getId()}selected{/if}>
                {$i->getFirstName()} {$i->getLastName()}
            </option>
        {/foreach}
    </select>

    <label for="field">Campo</label>
    <select name="field" id="field">
        {foreach from=$fields item=f}
            <option value="{$f->getId()}" {if $field == $f->getId()}selected{/if}>
                {$f->getSport()} - {$f->getType()} ({$f->getCostPerHour()}€/h)
            </option>
        {/foreach}
    </select>

    <button type="submit">Conferma</button>
</form>
