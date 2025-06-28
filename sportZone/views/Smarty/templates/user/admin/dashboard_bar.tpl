{extends file=$layout}


{block name="styles"}
  {block name="dashboard_tabs_styles"}{/block}
{/block}


{block name="content"}
  <section>
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <a href="/dashboard/manageCourses" class="nav-link{if $active_tab == 'manageCourses'} active{/if}">Gestisci Corsi</a>
      </li>
      <li class="nav-item">
        <a href="/dashboard/manageFields" class="nav-link{if $active_tab == 'manageFields'} active{/if}">Gestisci Campi</a>
      </li>
      <li class="nav-item">
        <a href="/dashboard/manageReservations" class="nav-link{if $active_tab == 'manageReservations'} active{/if}">Gestisci Prenotazioni</a>
      </li>
      <li class="nav-item">
        <a href="/dashboard/manageUsers" class="nav-link{if $active_tab == 'manageEmployees'} active{/if}">Gestisci Impiegati</a>
      </li>
      </li>
    </ul>

    <div class="dashboard-content p-4">
      {block name="dashboard_content"}{/block}
    </div>
  </section>
{/block}
