{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageUsers"}
{assign var="page_title" value="Dashboard - Gestione Utenti"}

{block name="dashboard_content"}
    <div class="container py-4" style="max-width: 900px;">
        <h2 class="mb-4">Gestisci Utenti</h2>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="userName" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="userName" placeholder="Nome utente" oninput="filterUsers()">
            </div>
            <div class="col-md-6 d-flex align-items-end gap-2">
                <a href="/user/userCreationForm" class="btn btn-outline-primary">+ Crea Utente</a>
            </div>
        </div>

        <hr>

        <h4 class="mb-4">Risultati:</h4>

        {if $users|@count > 0}
            <div class="row row-cols-1 row-cols-md-2 g-4" id="users-list">
                {foreach from=$users item=user}
                    <div class="col user-card" data-username="{$user.name|escape}">
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

    {literal}
        <script>
        function filterUsers() {
            const input = document.getElementById('userName').value.toLowerCase().trim();
            const inputParts = input.split(/\s+/).filter(Boolean); // split by spaces, remove empty
            const cards = document.querySelectorAll('.user-card');
            cards.forEach(card => {
                const title = card.querySelector('.card-title');
                let name = '', surname = '';
                if (title) {
                    const parts = title.textContent.trim().toLowerCase().split(/\s+/);
                    name = parts[0] || '';
                    surname = parts[1] || '';
                }
                // Show card if all input parts match either name or surname
                const matches = inputParts.every(part =>
                    name.includes(part) || surname.includes(part)
                );
                if (input === '' || matches) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        </script>
    {/literal}
{/block}