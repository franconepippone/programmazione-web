<h2>Creazione nuovo corso</h2>

<form method="post" action="/employee/createCourseForm">
    <label>Nome:</label>
    <input type="text" name="name" value="{$name|default:''}"><br>

    <label>Data inizio:</label>
    <input type="date" name="start_date" value="{$start_date|default:''}"><br>

    <label>Orario inizio:</label>
    <input type="time" name="start_time" value="{$start_time|default:''}"><br>

    <label>Orario fine:</label>
    <input type="time" name="end_time" value="{$end_time|default:''}"><br>

    <label>Giorni della settimana:</label><br>
    {assign var=weekdays value=["Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica"]}
    {foreach from=$weekdays item=day}
        <label><input type="checkbox" name="days[]" value="{$day}" {if $days && in_array($day, $days)}checked{/if}> {$day}</label><br>
    {/foreach}

    <label>ID Istruttore:</label>
    <input type="text" name="instructor" value="{$instructor|default:''}"> <!-- getInstructor() --><br>

    <label>ID Campo:</label>
    <input type="text" name="field" value="{$field|default:''}"> <!-- getField() --><br><br>

    <button type="submit" formaction="/employee/finalizeCreateCourse">Conferma</button>
</form>
