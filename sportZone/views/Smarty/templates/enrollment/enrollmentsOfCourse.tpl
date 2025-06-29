{extends file=$layout}
{assign var="page_title" value="Iscritti al Corso"}

{block name="content"}
<div class="container my-4">

  <!-- Bottone torna indietro -->
  <div class="mb-3">
    <a href="/dashboard/courseDetailsInstructor/{$course_id}" class="btn btn-secondary">
      &larr; Torna ai dettagli del corso
    </a>
  </div>

  <h2 class="mb-4 text-center">Iscritti al corso</h2>

  {if $enrollments|@count > 0}
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Email</th>
            <th>Data iscrizione</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$enrollments item=enrollment}
            <tr>
              {if $enrollment.client}
                 <td>{$enrollment.client.name|escape}</td>
                 <td>{$enrollment.client.surname|escape}</td>
                 <td>{$enrollment.client.email|escape}</td>
                 <td>{$enrollment.enrollmentDate|date_format:"%d/%m/%Y"|escape}</td>
              {else} 
                 <td colspan="3">Nessun cliente associato</td>
              {/if} 
            </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  {else}
    <div class="alert alert-info text-center">
      Nessun iscritto presente per questo corso.
    </div>
  {/if}

</div>
{/block}