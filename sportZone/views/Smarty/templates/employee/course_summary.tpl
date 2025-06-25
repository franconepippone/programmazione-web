<div class="summary-wrapper">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    <h2>Riepilogo corso</h2>
    <ul>
        <li><b>Titolo:</b> {$title|escape}</li>
        <li><b>Descrizione:</b> {$description|escape}</li>
        <li><b>Data inizio:</b> {$start_date}</li>
        <li><b>Orario:</b> {$start_time} - {$end_time}</li>
        <li><b>Giorni:</b> {$days_string}</li>
        <li><b>Costo:</b> {$cost} €</li>
        <li><b>Max partecipanti:</b> {$max_participants}</li>
        <li><b>Istruttore:</b> {$instructor.name} {$instructor.surname}</li>
        <li><b>Campo:</b> {$field.name}</li>
    </ul>
    <form method="post" action="/employee/finalizeCourse">
        <input type="hidden" name="title" value="{$title|escape}">
        <input type="hidden" name="description" value="{$description|escape}">
        <input type="hidden" name="start_date" value="{$start_date}">
        <input type="hidden" name="start_time" value="{$start_time}">
        <input type="hidden" name="end_time" value="{$end_time}">
        {foreach from=$days item=day}
            <input type="hidden" name="days[]" value="{$day}">
        {/foreach}
        <input type="hidden" name="cost" value="{$cost}">
        <input type="hidden" name="max_participants" value="{$max_participants}">
        <input type="hidden" name="instructor" value="{$instructor.id}">
        <input type="hidden" name="field" value="{$field.id}">
        <button type="submit">Conferma</button>
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    <h2>📋 Riepilogo del corso</h2>
    <div class="summary-item"><span class="label">Titolo:</span> <span class="value">{$data.title|escape}</span></div>
    <div class="summary-item"><span class="label">Descrizione:</span> <span class="value">{$data.description|escape}</span></div>
    <div class="summary-item"><span class="label">Data inizio:</span> <span class="value">{$data.start_date}</span></div>
    <div class="summary-item"><span class="label">Orario:</span> <span class="value">{$data.start_time} - {$data.end_time}</span></div>
    <div class="summary-item"><span class="label">Giorni:</span> <span class="value">{$data.days_string}</span></div>
    <div class="summary-item"><span class="label">Istruttore:</span> <span class="value">{$data.instructor.name} {$data.instructor.surname}</span></div>
    <div class="summary-item"><span class="label">Campo:</span> <span class="value">{$data.field.name}</span></div>
    <div class="summary-item"><span class="label">Costo iscrizione:</span> <span class="value">{$data.cost} €</span></div>
    <div class="summary-item"><span class="label">Numero massimo partecipanti:</span> <span class="value">{$data.max_participants}</span></div>

    <form method="post" action="/employee/finalizeCourse">
        <input type="hidden" name="title" value="{$data.title|escape}">
        <input type="hidden" name="description" value="{$data.description|escape}">
        <input type="hidden" name="start_date" value="{$data.start_date}">
        <input type="hidden" name="start_time" value="{$data.start_time}">
        <input type="hidden" name="end_time" value="{$data.end_time}">
        <input type="hidden" name="cost" value="{$data.cost}">
        <input type="hidden" name="max_participants" value="{$data.max_participants}">
        <input type="hidden" name="instructor" value="{$data.instructor.id}">
        <input type="hidden" name="field" value="{$data.field.id}">
        {foreach from=$data.days item=day}
            <input type="hidden" name="days[]" value="{$day}">
        {/foreach}
        <button class="confirm-button" type="submit">✅ Conferma Creazione</button>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    </form>
</div>