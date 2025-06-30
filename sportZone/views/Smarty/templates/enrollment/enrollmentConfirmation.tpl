{extends file=$layout}  
{assign var="page_title" value="Register new"}



{block name="content"}
    <div class="container py-4">
        <h2 class="mb-4">Modulo di iscrizione</h2>
        <p>Corso: <strong>{$course.title|escape}</strong></p>

        <dl class="row mb-4">
            <dt class="col-sm-3">Nome:</dt>
            <dd class="col-sm-9">{$user.name|escape}</dd>

            <dt class="col-sm-3">Cognome:</dt>
            <dd class="col-sm-9">{$user.surname|escape}</dd>

            <dt class="col-sm-3">Data di nascita:</dt>
            <dd class="col-sm-9">{$user.birthDate|date_format:"%d/%m/%Y"}</dd>

            <dt class="col-sm-3">Sesso:</dt>
            <dd class="col-sm-9">{$user.sex|escape}</dd>

            <dt class="col-sm-3">Email:</dt>
            <dd class="col-sm-9">{$user.email|escape}</dd>

            <dt class="col-sm-3">Username:</dt>
            <dd class="col-sm-9">{$user.username|escape}</dd>
        </dl>

        <div class="d-flex gap-3">
            <a href="/enrollment/enrollForm/{$course.id}" class="btn btn-secondary">Modifica dati</a>
            <a href="/enrollment/finalizeEnrollment_pay/{$course.id}" class="btn btn-primary">Conferma iscrizione</a>
        </div>
    </div>
{/block}
