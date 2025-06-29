{extends file="../dashboard_bar.tpl"}

{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/details.css">
{/block}

{block name="dashboard_content"}
<div class="container my-4">
    <h2 class="mb-4">Dettagli Corso</h2>

    {foreach from=$courses item=course}
    <div class="card mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">ID:</dt>
                <dd class="col-sm-8">{$course.id|default:'N/D'}</dd>

                <dt class="col-sm-4">Titolo:</dt>
                <dd class="col-sm-8">{$course.title|default:'N/D'|escape}</dd>

                <dt class="col-sm-4">Descrizione:</dt>
                <dd class="col-sm-8">{$course.description|default:'N/D'|escape}</dd>

                <dt class="col-sm-4">Data inizio:</dt>
                <dd class="col-sm-8">
                    {if $course.startDate}
                        {$course.startDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </dd>

                <dt class="col-sm-4">Data fine:</dt>
                <dd class="col-sm-8">
                    {if $course.endDate}
                        {$course.endDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </dd>

                <dt class="col-sm-4">Fascia oraria:</dt>
                <dd class="col-sm-8">{$course.timeSlot|default:'N/D'}</dd>

                <dt class="col-sm-4">Giorni:</dt>
                <dd class="col-sm-8">
                    {if $course.daysOfWeek|@count > 0}
                        {foreach from=$course.daysOfWeek item=day name=giorni}
                            {$day}{if !$smarty.foreach.giorni.last}, {/if}
                        {/foreach}
                    {else}
                        N/D
                    {/if}
                </dd>

                <dt class="col-sm-4">Costo:</dt>
                <dd class="col-sm-8">
                    {if $course.cost !== null && $course.cost !== ''}
                        {$course.cost} €
                    {else}
                        N/D
                    {/if}
                </dd>

                <dt class="col-sm-4">Max partecipanti:</dt>
                <dd class="col-sm-8">{$course.MaxParticipantsCount|default:'N/D'}</dd>

                <dt class="col-sm-4">Campo:</dt>
                <dd class="col-sm-8">{$course.field|default:'N/D'}</dd>

                <dt class="col-sm-4">Istruttore:</dt>
                <dd class="col-sm-8">{$course.instructor|default:'N/D'}</dd>
            </dl>

            <h5 class="mt-4">Iscritti al corso:</h5>
            {if $enrollments|@count > 0}
                <ul class="list-group mb-3">
                    {foreach from=$enrollments item=client}
                        <li class="list-group-item">
                            {$client.name|escape} {$client.surname|escape}
                        </li>
                    {/foreach}
                </ul>
            {else}
                <p class="text-muted">Ancora nessun iscritto</p>
            {/if}

            <div class="d-flex justify-content-between">
                <a href="javascript:history.back()" class="btn btn-secondary">⬅ Torna indietro</a>
                <a href="/enrollment/showEnrollmentsOfCourse/{$course.id}" class="btn btn-outline-secondary">👥 Iscritti</a>
            </div>
        </div>
    </div>
    {/foreach}
</div>
{/block}
