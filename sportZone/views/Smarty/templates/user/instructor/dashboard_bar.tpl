{extends file=$layout}

{block name="styles"}
    {block name="dashboard_tabs_styles"}{/block}
{/block}

{block name="content"}
  <section class="container py-4">
    <div class="nav nav-tabs mb-4">
        <a href="/dashboard/profile" class="nav-link{if $active_tab == 'profile'} active{/if}">Profilo</a>
        <a href="/dashboard/myCourses" class="nav-link{if $active_tab == 'courses'} active{/if}">Corsi insegnati</a>
        <a href="/dashboard/settings" class="nav-link{if $active_tab == 'settings'} active{/if}">Impostazioni</a>
    </div>
    {block name="dashboard_content"}
    <!-- Contenuto specifico della tab qui -->
    {/block}
  </section>
{/block}
