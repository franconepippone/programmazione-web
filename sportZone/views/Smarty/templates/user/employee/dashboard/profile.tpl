{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="profile"}
{assign var="page_title" value="Dashboard - Il mio profilo"}

{block name="dashboard_tabs_styles"}
{/block}

{block name="dashboard_content"}
    <h2>Il mio profilo (Impiegato)</h2>
    <p>Aggiorna le tue informazioni personali qui sotto.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form" enctype="multipart/form-data">
        {include file="user/modify_forms/profile/prfl_employee.tpl"}
        
        <button type="submit" class="btn btn-primary">Salva modifiche</button>
    </form>
{/block}
