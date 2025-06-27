{extends file=$layout}

{block name="styles"}
  {block name="dashboard_tabs_styles"}{/block}
  <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/templates/user/styles/dashboard.css">
{/block}

{block name="content"}
  <section class="dashboard">
    <div class="dashboard-tabs">
        <a href="/dashboard/profile" class="tab{if $active_tab == 'profile'} active{/if}">Profile</a>
        <a href="/dashboard/settings" class="tab{if $active_tab == 'settings'} active{/if}">Settings</a>
        <br>management
        <a href="/dashboard/manageCourses" class="tab{if $active_tab == 'manageCourses'} active{/if}">Manage Courses</a>
        <a href="/dashboard/manageFields" class="tab{if $active_tab == 'manageFields'} active{/if}">Manage Fields</a>
        <a href="/dashboard/manageReservations" class="tab{if $active_tab == 'manageReservations'} active{/if}">Manage Reservations</a>
        <a href="/dashboard/manageUsers" class="tab{if $active_tab == 'manageUsers'} active{/if}">Manage Users</a>
    </div>
      {block name="dashboard_content"}
      <!-- Contenuto specifico della tab qui -->
      {/block}
  </section>
{/block}