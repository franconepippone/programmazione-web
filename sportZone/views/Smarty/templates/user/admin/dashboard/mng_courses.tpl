{*stesso identico di employee (adrebbe templatizzato in file a partte*}

{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageCourses"}
{assign var="page_title" value="Dashboard - Corsi"}

{block name="dashboard_content"}
    <div class="results-list container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Risultati della Ricerca</h2>
            <a href="/course/createCourseForm" class="btn btn-primary">
                Crea Nuovo Corso
            </a>
        </div>

        {if $courses|@count > 0}
            <div class="row row-cols-1 row-cols-md-2 g-4">
                {foreach from=$courses item=course}
                    <div class="col">
                        <div class="card h-100">
                            <input type="hidden" name="id" value="{$course.id}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" name="title">{$course.title|escape}</h5>
                                <p class="card-text mb-3" name="startDate">
                                    <strong>Inizio:</strong> {$course.startDate|date_format:"%d/%m/%Y"}
                                </p>
                                <a href="/course/courseDetails/{$course.id}" class="btn btn-primary mt-auto align-self-start">
                                    Dettagli
                                </a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        {else}
            <p>Nessun risultato trovato con i filtri selezionati.</p>
        {/if}
    </div>
{/block}