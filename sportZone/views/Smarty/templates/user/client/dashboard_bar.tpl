{extends file=$layout}

{block name="styles"}
  {block name="dashboard_tabs_styles"}{/block}
<style>

.dashboard {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 1rem;
}
.dashboard-tabs {
    display: flex;
    justify-content: flex-start;
    width: 100vw;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    position: relative;
    border-bottom: 2px solid #1f2937;
    background: #1f2937;
    gap: 0;
    z-index: 2;
    margin-top: 0;
    padding: 0.5rem 0;
}
.dashboard-tabs .tab {
    flex: 0 0 auto;
    text-align: center;
    padding: 0.7rem 2.2rem;
    margin: 0 0.2rem;
    text-decoration: none;
    color: #d1d5db;
    font-weight: 600;
    border: none;
    border-radius: 0.375rem 0.375rem 0 0;
    background: #374151;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    cursor: pointer;
    position: relative;
    top: 2px;
}
.dashboard-tabs .tab:hover {
    background: #2563eb;
    color: #fff;
}
.dashboard-tabs .tab.active {
    background: #fff;
    color: #1f2937;
    box-shadow: 0 4px 12px rgba(31,41,55,0.08);
    border-bottom: 2px solid #fff;
    z-index: 3;
}
.dashboard-content {
    background: #fff;
    padding: 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 1px 6px rgb(0 0 0 / 0.1);
    min-height: 300px;
    margin-top: 0;
}
</style>

{/block}

{block name="content"}
  <section class="dashboard">
    <div class="dashboard-tabs">
        <a href="/client/profile" class="tab{if $active_tab == 'profile'} active{/if}">Profile</a>
        <a href="/client/myCourses" class="tab{if $active_tab == 'courses'} active{/if}">My Courses</a>
        <a href="/client/myReservations" class="tab{if $active_tab == 'reservations'} active{/if}">My Reservations</a>
        <a href="/client/settings" class="tab{if $active_tab == 'settings'} active{/if}">Settings</a>
    </div>
      {block name="dashboard_content"}
      <!-- Contenuto specifico della tab qui -->
      {/block}
  </section>
{/block}