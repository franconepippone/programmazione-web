{extends file=$layout}

{block name="styles"}
    {block name="dashboard_tabs_styles"}{/block}
        
{/block}

{block name="content"}
<section class="dashboard container py-4">
    <div class="row mb-4">
        <div class="col">
            <div class="nav nav-tabs justify-content-start">
                <a href="/dashboard/profile" class="nav-link{if $active_tab == 'profile'} active{/if}">Profilo</a>
                <a href="/dashboard/myEnrollments" class="nav-link{if $active_tab == 'courses'} active{/if}">I miei corsi</a>
                <a href="/dashboard/myReservations" class="nav-link{if $active_tab == 'reservations'} active{/if}">Le mie prenotazioni</a>
                <a href="/dashboard/settings" class="nav-link{if $active_tab == 'settings'} active{/if}">Impostazioni</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            {block name="dashboard_content"}
            <!-- Contenuto specifico della tab -->
            {/block}
        </div>
    </div>
</section>
{/block}
