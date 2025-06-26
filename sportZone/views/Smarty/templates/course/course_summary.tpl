<div class="summary-wrapper">
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
    <form method="post" action="/course/finalizeCourse">
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
    </form>
</div>
