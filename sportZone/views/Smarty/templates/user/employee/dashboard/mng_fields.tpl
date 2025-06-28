{extends file="../dashboard_bar.tpl"}
{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/details.css">
{/block}

{block name="dashboard_content"}
    <div class="form">
        <h2 class="form__title">Dettagli Corso</h2>
        {foreach from=$courses item=course}
        <div class="form__content">
            <div class="form__group">
                <label class="form__label" for="id">ID:</label>
                <div class="form__value" id="id">{$course.id|default:'N/D'}</div>
            </div>
            <div class="form__group">
                <label class="form__label" for="title">Titolo:</label>
                <div class="form__value" id="title">{$course.title|default:'N/D'|escape}</div>
            </div>
            <div class="form__group">
                <label class="form__label" for="description">Descrizione:</label>
                <div class="form__value" id="description">{$course.description|default:'N/D'|escape}</div>
            </div>
            <div class="form__group">
                <label class="form__label" for="startDate">Data inizio:</label>
                <div class="form__value" id="startDate">
                    {if $course.startDate}
                        {$course.startDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="form__group">
                <label class="form__label" for="endDate">Data fine:</label>
                <div class="form__value" id="endDate">
                    {if $course.endDate}
                        {$course.endDate|date_format:"%d/%m/%Y"}
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="form__group">
                <label class="form__label" for="timeSlot">Fascia oraria:</label>
                <div class="form__value" id="timeSlot">{$course.timeSlot|default:'N/D'}</div>
            </div>
            <div class="form__group">
                <label class="form__label" for="daysOfWeek">Giorni:</label>
                <div class="form__value" id="daysOfWeek">
                    {if $course.daysOfWeek|@count > 0}
                        {foreach from=$course.daysOfWeek item=day name=giorni}
                            {$day}{if !$smarty.foreach.giorni.last}, {/if}
                        {/foreach}
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="form__group">
                <label class="form__label" for="cost">Costo:</label>
                <div class="form__value" id="cost">
                    {if $course.cost !== null && $course.cost !== ''}
                        {$course.cost} €
                    {else}
                        N/D
                    {/if}
                </div>
            </div>
            <div class="form__group">
                <label class="form__label" for="MaxParticipantsCount">Max partecipanti:</label>
                <div class="form__value" id="MaxParticipantsCount">{$course.MaxParticipantsCount|default:'N/D'}</div>
            </div>
            <div class="form__group">
                <label class="form__label" for="field">Campo:</label>
                <div class="form__value" id="field">{$course.field|default:'N/D'}</div>
            </div>
            <div class="form__group">
                <label class="form__label" for="instructor">Istruttore:</label>
                <div class="form__value" id="instructor">{$course.instructor|default:'N/D'}</div>
            </div>
        </div>

        <div class="form__group" style="margin-top: 2rem; text-align: center;">
            <button type="button" class="form__button" onclick="history.back()">⬅ Torna indietro</button>
        </div>
        {/foreach}
    </div>
{/block}
