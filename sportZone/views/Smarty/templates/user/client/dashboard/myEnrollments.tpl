{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="courses"}



{block name="dashboard_content"}
    <div class="results-list container py-4">
        <h2 class="mb-4">Le mie iscrizioni</h2>
        {if $enrollments|@count > 0}
            <div class="row row-cols-1 row-cols-md-2 g-4">
                {foreach from=$enrollments item=enrollment}
                    <div class="col">
                        <div class="card h-100">
                            <input type="hidden" name="id" value="{$enrollment.id}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" name="title">{$enrollment.course['title']|escape}</h5>
                                <p class="card-text mb-2" name="enrollmentDate">
                                    <strong>Iscritto il:</strong> {$enrollment.enrollmentDate|date_format:"%d/%m/%Y"}
                                </p>
                                <p class="card-text mb-3" name="description">
                                    {$enrollment.course['description']|escape}
                                </p>
                                <p class="card-text mt-auto" name="client">
                                    <strong>Utente:</strong> 
                                    {if $enrollment.client && $enrollment.client[0]}
                                        {$enrollment.client[0]['name']|escape} {$enrollment.client[0]['surname']|escape}
                                    {/if}
                                </p>
                                <a href="/dashboard/courseDetailsClient/{$enrollment.course['id']}" class="btn btn-primary mt-3 align-self-start">
                                    Dettagli corso
                                </a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        {else}
            <p>Non hai ancora effettuato iscrizioni a corsi.</p>
        {/if}
    </div>
{/block}
