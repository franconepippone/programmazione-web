{extends file=$layout}

{block name="styles"}
  {block name="dashboard_tabs_styles"}{/block}
  <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/templates/user/styles/dashboard.css">
{/block}

{block name="content"}
  <section class="dashboard">
    <div class="dashboard-tabs">
        <a href="/dashboard/profile" class="tab{if $active_tab == 'profile'} active{/if}">Profile</a>
        <a href="/dashboard/myCourses" class="tab{if $active_tab == 'courses'} active{/if}">My courses</a>
        <a href="/dashboard/settings" class="tab{if $active_tab == 'settings'} active{/if}">Settings</a>
    </div>
      {block name="dashboard_content"}
      <!-- Contenuto specifico della tab qui -->
      {/block}
  </section>
{/block}