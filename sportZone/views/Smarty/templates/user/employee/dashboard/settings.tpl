{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="settings"}
{assign var="page_title" value="Dashboard - Impostazioni"}

{block name="dashboard_content"}

    <h2 class="mb-4">Impostazioni</h2>
    <p class="text-muted">Cambia la tua password, aggiorna le preferenze email e altro ancora.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form">
        <div class="mb-4">
            <label for="username" class="form-label">Nome utente</label>
            <input type="text" id="username" name="username" value="{$user.username|escape}" required class="form-control">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="{$user.email|escape}" required readonly class="form-control">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Nuova password</label>
            <input type="password" id="password" name="password" class="form-control">
            <small class="text-muted">Lascia vuoto per mantenere la password attuale</small>
        </div>

        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </div>
    </form>
{/block}
