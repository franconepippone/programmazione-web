{extends file=$layout}
{assign var="page_title" value="Dashboard - Settings"}

{block name="content"}
    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm w-100" style="max-width: 720px;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-center">Crea un nuovo corso</h2>

                <form method="post" action="/course/courseSummary" novalidate>
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" name="title" id="title" value="{$title|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <input type="text" name="description" id="description" value="{$description|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Data inizio</label>
                        <input type="date" name="start_date" id="start_date" value="{$start_date|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Data fine</label>
                        <input type="date" name="end_date" id="end_date" value="{$end_date|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="cost" class="form-label">Costo iscrizione</label>
                        <input type="text" name="cost" id="cost" value="{$cost|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="max_participants" class="form-label">Numero massimo partecipanti</label>
                        <input type="number" name="max_participants" id="max_participants" value="{$max_participants|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giorni della settimana</label>
                        <div class="row row-cols-2 row-cols-md-3 g-2">
                            {foreach from=['Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato','Domenica'] item=day}
                                <div class="form-check col">
                                    <input type="checkbox" class="form-check-input" name="days[]" id="day_{$day}" value="{$day}" 
                                           {if isset($days) && $day|in_array:$days}checked{/if}>
                                    <label class="form-check-label" for="day_{$day}">{$day}</label>
                                </div>
                            {/foreach}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="instructor" class="form-label">Istruttore</label>
                        <select name="instructor" id="instructor" class="form-select" required>
                            <option value="">Seleziona...</option>
                            {foreach from=$instructors item=inst}
                                <option value="{$inst.id}" {if $inst.id == ($instructor|default:'')}selected{/if}>
                                    {$inst.name} {$inst.surname}
                                </option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="field" class="form-label">Campo</label>
                        <select name="field" id="field" class="form-select" required>
                            <option value="">Seleziona...</option>
                            {foreach from=$fields item=field}
                                <option value="{$field.id}" {if $field.id == ($field|default:'')}selected{/if}>
                                    {$field.name}
                                </option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="duration" class="form-label">Durata del corso (ore)</label>
                        <select name="duration" id="duration" class="form-select" required>
                            <option value="">Seleziona durata...</option>
                            <option value="1" {if $duration|default:'' == '1'}selected{/if}>1 ora</option>
                            <option value="2" {if $duration|default:'' == '2'}selected{/if}>2 ore</option>
                            <option value="3" {if $duration|default:'' == '3'}selected{/if}>3 ore</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold mb-4">Continua</button>
                    {*
                    <a href="/user/home" class="btn btn-secondary w-100 fw-semibold">Torna alla homepage</a>
                    *}
                </form>
            </div>
        </div>
    </div>
{/block}