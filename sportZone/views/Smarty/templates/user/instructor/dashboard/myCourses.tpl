{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="courses"}

{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/results.css">
{/block}

{block name="dashboard_content"}
    <div class="results-list">
        <h2>Risultati della Ricerca</h2>
        {if $courses|@count > 0}
            {foreach from=$courses item=course}
                <div class="result-card">
                    <!-- id nascosto -->
                    <input type="hidden" name="id" value="{$course.id}">
                    <div class="result-info">
                        <div class="result-title" name="title">{$course.title|escape}</div>
                        <div class="result-date" name="startDate">
                            Inizio: {$course.startDate|date_format:"%d/%m/%Y"}
                        </div>
                    </div>
                    <a class="details-btn" href="/course/courseDetailsInstructor/{$course.id}">Modifica</a>
                </div>
            {/foreach}
        {else}
            <p>Nessun risultato trovato con i filtri selezionati.</p>
        {/if}
    </div>
{/block}