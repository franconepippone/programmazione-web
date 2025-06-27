{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="courses"}
 
{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/results.css">
{/block}
{block name="dashboard_content"}
    <div class="results-list">
        <h2>Le mie iscrizioni</h2>
        {if $enrollments|@count > 0}
            {foreach from=$enrollments item=enrollment}
                <div class="result-card">
                    <input type="hidden" name="id" value="{$enrollment.id}">
                    <div class="result-info">
                        <div class="result-title" name="title">
                            {$enrollment.course['title']|escape}
                        </div>
                        <div class="result-date" name="enrollmentDate">
                            Iscritto il: {$enrollment.enrollmentDate|date_format:"%d/%m/%Y"}
                        </div>
                        <div class="result-description" name="description">
                            {$enrollment.course['description']|escape}
                        </div>
                        <div class="result-client" name="client">
                            Utente: 
                            {if $enrollment.client && $enrollment.client[0]}
                                {$enrollment.client[0]['name']|escape} {$enrollment.client[0]['surname']|escape}
                            {/if}
                        </div>
                    </div>
                    <a class="details-btn" href="/dashboard/courseDetailsClient/{$enrollment.course['id']}">Dettagli corso</a>
                </div>
            {/foreach}
        {else}
            <p>Non hai ancora effettuato iscrizioni a corsi.</p>
        {/if}
    </div>
{/block}

   

