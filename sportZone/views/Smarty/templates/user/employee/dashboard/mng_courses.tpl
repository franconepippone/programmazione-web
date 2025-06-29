{extends file="../dashboard_bar.tpl"}

{block name="dashboard_tabs_styles"}
{/block}
{block name="content"}
    <div class="results-list container py-4">
        <h2 class="mb-4">Risultati della Ricerca</h2>
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