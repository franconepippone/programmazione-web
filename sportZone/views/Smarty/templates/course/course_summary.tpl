<div class="summary-wrapper">
   <h2>Riepilogo corso</h2>
<ul>
    <li><b>Titolo:</b> {$title|escape}</li>
    <li><b>Descrizione:</b> {$description|escape}</li>
    <li><b>Data inizio:</b> {$start_date}</li>
    <li><b>Data fine:</b> {$end_date}</li>
    <li><b>Giorni:</b> {$days_string}</li>
    <li><b>Costo:</b> {$cost} €</li>
    <li><b>Max partecipanti:</b> {$max_participants}</li>
    <li><b>Istruttore:</b> {$instructor.name} {$instructor.surname}</li>
    <li><b>Campo:</b> {$field.name}</li>
    <li><b>Metodo di pagamento:</b> 
        {if $paymentMethod == "onsite"}Pagamento in loco
        {elseif $paymentMethod == "online"}Pagamento online
        {else}{$paymentMethod|escape}{/if}
    </li>
</ul>

<form method="post" action="/course/finalizeCourse">
    <input type="hidden" name="title" value="{$title|escape}">
    <input type="hidden" name="description" value="{$description|escape}">
    <input type="hidden" name="start_date" value="{$start_date}">
    <input type="hidden" name="end_date" value="{$end_date}">
    {foreach from=$days item=day}
        <input type="hidden" name="days[]" value="{$day}">
    {/foreach}
    <input type="hidden" name="cost" value="{$cost}">
    <input type="hidden" name="max_participants" value="{$max_participants}">
    <input type="hidden" name="instructor" value="{$instructor.id}">
    <input type="hidden" name="field" value="{$field.id}">

    <label for="start_time"><b>Orario inizio:</b></label>
    <select name="start_time" id="start_time" required>
        {foreach from=$available_hours item=hour}
            <option value="{$hour}">{$hour|truncate:5:""}</option>
        {/foreach}
    </select>
    
    <label for="end_time"><b>Orario fine:</b></label>
    <select name="end_time" id="end_time" required>
        {foreach from=$available_hours item=hour}
            <option value="{$hour}">{$hour|truncate:5:""}</option>
        {/foreach}
    </select>

    <div style="margin-top:20px;">
        <button type="submit" class="submit-button">Conferma</button>
    </div>
</form>