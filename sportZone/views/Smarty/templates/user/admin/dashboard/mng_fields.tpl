{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageFields"}
{assign var="page_title" value="Dashboard - Gestione Campi Sportivi"}

{block name="dashboard_tabs_styles"}
{/block}

{block name="dashboard_content"}
    {include file="user/management_templates/manage_fields.tpl"}
{/block}