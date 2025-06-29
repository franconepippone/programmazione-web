{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="courses"}



{block name="dashboard_content"}
    <div class="container my-4">
        <h2 class="mb-4">Risultati della Ricerca</h2>
        {if $courses|@count > 0}
            <div class="row row-cols-1 row-cols-md-2 g-4">
                {foreach from=$courses item=course}
                    <div class="col">
                        <div class="card h-100">
                            <input type="hidden" name="id" value="{$course.id}">
                            <div class="card-body">
                                <h5 class="card-title" name="title">{$course.title|escape}</h5>
                                <p class="card-text" name="startDate">
                                    Inizio: {$course.startDate|date_format:"%d/%m/%Y"}
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="/dashboard/courseDetailsInstructor/{$course.id}" class="btn btn-primary">
                                    Dettagli
                                </a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        {else}
            <div class="alert alert-warning" role="alert">
                Nessun risultato trovato con i filtri selezionati.
            </div>
        {/if}
    </div>
{/block}
