{extends file=$layout}

{block name="styles"}
  {block name="dashboard_tabs_styles"}{/block}
{/block}

{assign var="ManageTabActive" value=in_array($active_tab, ['manageCourses', 'manageFields', 'manageReservations'])}

{block name="content"}
  <section>
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <a href="/dashboard/profile" class="nav-link{if $active_tab == 'profile'} active{/if}">Profilo</a>
      </li>
      <li class="nav-item">
        <a href="/dashboard/settings" class="nav-link{if $active_tab == 'settings'} active{/if}">Impostazioni</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {if $ManageTabActive} active{/if}" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Gestione</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item{if $active_tab == 'manageCourses'} active{/if}" href="/dashboard/manageCourses">Gestisci Corsi</a></li>
          <li><a class="dropdown-item{if $active_tab == 'manageFields'} active{/if}" href="/dashboard/manageFields">Gestisci Campi</a></li>
          <li><a class="dropdown-item{if $active_tab == 'manageReservations'} active{/if}" href="/dashboard/manageReservations">Gestisci Prenotazioni</a></li>
          <!-- <li><a class="dropdown-item{if $active_tab == 'manageUsers'} active{/if}" href="/dashboard/manageUsers">Gestisci Clienti</a></li> -->
        </ul>
      </li>
    </ul>

    <div class="dashboard-content p-4">
      {block name="dashboard_content"}{/block}
    </div>
  </section>
{/block}
