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
              <td>{$enrollment.name|escape}</td>
              <td>{$enrollment.surname|escape}</td>
              <td>{$enrollment.email|escape}</td>
              <td>{$enrollment.date|date_format:"%d/%m/%Y"}</td>
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