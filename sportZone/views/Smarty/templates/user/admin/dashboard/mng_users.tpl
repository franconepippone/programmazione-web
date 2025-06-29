{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageUsers"}
{assign var="page_title" value="Dashboard - Gestione Utenti"}

{block name="dashboard_content"}
    <div class="container my-4">
        <h2 class="mb-4">Lista Utenti</h2>
        <a href="/user/userCreationForm" class="btn btn-success">
                ➕ Crea Utente
        </a>

        {if $users|@count > 0}
            <div class="row row-cols-1 row-cols-md-2 g-4">
                {foreach from=$users item=user}
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {$user.name|default:'N/A'|escape} {$user.surname|default:'N/A'|escape}
                                </h5>
                                <p class="card-text mb-1"><strong>Email:</strong> {$user.email|default:'N/A'|escape}</p>
                                <p class="card-text mb-1"><strong>Username:</strong> {$user.username|default:'N/A'|escape}</p>
                                <p class="card-text mb-1"><strong>Sesso:</strong> {$user.sex|default:'N/A'|escape}</p>
                                <p class="card-text mb-1">
                                    <strong>Data di nascita:</strong> 
                                    {if isset($user.birthDate) && $user.birthDate}
                                        {$user.birthDate|date_format:"%d/%m/%Y"}
                                    {else}
                                        N/A
                                    {/if}
                                </p>
                                
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="/user/modifyUserForm/{$user.id|default:0}" class="btn btn-primary">Modifica</a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        {else}
            <div class="alert alert-warning" role="alert">
                Nessun utente trovato.
            </div>
        {/if}
    </div>
{/block}
