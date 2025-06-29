{extends file=$layout}
{assign var="page_title" value="Dashboard - Settings"}

{block name="content"}
    <div class="container py-4">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Riepilogo Corso</h2>

                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Titolo:</strong> {$title|escape}</li>
                    <li class="list-group-item"><strong>Descrizione:</strong> {$description|escape}</li>
                    <li class="list-group-item"><strong>Data inizio:</strong> {$start_date}</li>
                    <li class="list-group-item"><strong>Data fine:</strong> {$end_date}</li>
                    <li class="list-group-item"><strong>Giorni:</strong> {$days_string}</li>
                    <li class="list-group-item"><strong>Costo:</strong> {$cost} €</li>
                    <li class="list-group-item"><strong>Max partecipanti:</strong> {$max_participants}</li>
                    <li class="list-group-item"><strong>Istruttore:</strong> {$instructor.name} {$instructor.surname}</li>
                    <li class="list-group-item"><strong>Campo:</strong> {$field.name}</li>
                    <li class="list-group-item"><strong>Metodo di pagamento:</strong>
                        {if $paymentMethod == "onsite"}Pagamento in loco
                        {elseif $paymentMethod == "online"}Pagamento online
                        {else}{$paymentMethod|escape}{/if}
                    </li>
                    <li class="list-group-item"><strong>Durata:</strong> {$duration} {if $duration > 1}ore{else}ora{/if}</li>
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
                    <input type="hidden" name="duration" value="{$duration}">

                    <div class="mb-3">
                        <label for="start_time" class="form-label"><strong>Orario inizio:</strong></label>
                        <select name="start_time" id="start_time" required class="form-select">
                            {foreach from=$possiblehours item=hour}
                                <option value="{$hour}">{$hour|truncate:5:""}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-primary fw-semibold mb-3">Conferma</button>
                        <a href="javascript:history.back()" class="btn btn-secondary w-100 fw-semibold">Torna indietro</a>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
{/block}
