{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageReservations"}
{assign var="page_title" value="Dashboard - Gestione Prenotazioni"}

{block name="dashboard_content"}
    {include file="user/management_templates/manage_res_show_filtered.tpl"}
{/block}