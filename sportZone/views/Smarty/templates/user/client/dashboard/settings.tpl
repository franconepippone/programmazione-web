{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="settings"}
{assign var="page_title" value="Dashboard - Impostazioni"}

{block name="dashboard_tabs_styles"}
{/block}

{block name="dashboard_content"}
    <div class="container py-4">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title">Impostazioni</h2>
                <p class="mb-4">Modifica la tua password, aggiorna le preferenze email e altro ancora.</p>

                <form action="/user/modifyUserRequest" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome utente</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-control" 
                            value="{$user.username|escape}" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control" 
                            value="{$user.email|escape}" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nuova password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control">
                        <div class="form-text">Lascia vuoto per mantenere la password attuale</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Salva modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{/block}
