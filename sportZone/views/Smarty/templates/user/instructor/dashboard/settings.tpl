{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="settings"}
{assign var="page_title" value="Dashboard - Impostazioni"}

{block name="dashboard_content"}

    <h2 class="mb-4">Impostazioni</h2>
    <p class="text-muted">Cambia la tua password, aggiorna le preferenze email e altro ancora.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form">
        {include file="user/modify_forms/settings/stgs_instructor.tpl"}

        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </div>
    </form>
{/block}
