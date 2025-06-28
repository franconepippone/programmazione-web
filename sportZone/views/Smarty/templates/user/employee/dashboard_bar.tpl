{extends file=$layout}

{block name="styles"}
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">
  {block name="dashboard_tabs_styles"}{/block}
{/block}

{block name="content"}
  <section class="container my-4">
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <a href="/dashboard/profile" class="nav-link{if $active_tab == 'profile'} active{/if}">Profile</a>
      </li>
      <li class="nav-item">
        <a href="/dashboard/settings" class="nav-link{if $active_tab == 'settings'} active{/if}">Settings</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Management</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item{if $active_tab == 'manageCourses'} active{/if}" href="/dashboard/manageCourses">Manage Courses</a></li>
          <li><a class="dropdown-item{if $active_tab == 'manageFields'} active{/if}" href="/dashboard/manageFields">Manage Fields</a></li>
          <li><a class="dropdown-item{if $active_tab == 'manageReservations'} active{/if}" href="/dashboard/manageReservations">Manage Reservations</a></li>
          <li><a class="dropdown-item{if $active_tab == 'manageUsers'} active{/if}" href="/dashboard/manageUsers">Manage Users</a></li>
        </ul>
      </li>
    </ul>

    <div class="dashboard-content">
      {block name="dashboard_content"}{/block}
    </div>
  </section>
{/block}
