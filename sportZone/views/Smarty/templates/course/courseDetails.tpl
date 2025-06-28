{extends file=$layout}  
{assign var="page_title" value="Register new"}



{block name="content"}
  <div class="container my-4">
    <h2 class="mb-4">Dettagli Corso</h2>

    {foreach from=$courses item=course}
      <div class="mb-4 p-3 border rounded">
        <div class="row mb-2">
          <div class="col-4 fw-semibold">ID:</div>
          <div class="col-8">{$course.id|default:'N/D'}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Titolo:</div>
          <div class="col-8">{$course.title|default:'N/D'|escape}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Descrizione:</div>
          <div class="col-8">{$course.description|default:'N/D'|escape}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Data inizio:</div>
          <div class="col-8">
            {if $course.startDate}
              {$course.startDate|date_format:"%d/%m/%Y"}
            {else}
              N/D
            {/if}
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Data fine:</div>
          <div class="col-8">
            {if $course.endDate}
              {$course.endDate|date_format:"%d/%m/%Y"}
            {else}
              N/D
            {/if}
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Fascia oraria:</div>
          <div class="col-8">{$course.timeSlot|default:'N/D'}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Giorni:</div>
          <div class="col-8">
            {if $course.daysOfWeek|@count > 0}
              {foreach from=$course.daysOfWeek item=day name=giorni}
                {$day}{if !$smarty.foreach.giorni.last}, {/if}
              {/foreach}
            {else}
              N/D
            {/if}
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Costo:</div>
          <div class="col-8">
            {if $course.cost !== null && $course.cost !== ''}
              {$course.cost} €
            {else}
              N/D
            {/if}
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Max partecipanti:</div>
          <div class="col-8">{$course.MaxParticipantsCount|default:'N/D'}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Campo:</div>
          <div class="col-8">{$course.field|default:'N/D'}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-semibold">Istruttore:</div>
          <div class="col-8">{$course.instructor|default:'N/D'}</div>
        </div>
      </div>

      <div class="d-flex justify-content-start gap-2">
        <a href="javascript:history.back()" class="btn btn-outline-primary">⬅ Torna indietro</a>
        <a href="/enrollment/enrollmentConfirmation/{$course.id}" class="btn btn-outline-primary">Iscriviti</a>
      </div>
    {/foreach}
  </div>

  
{/block}
