{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageReservations"}
{assign var="page_title" value="Dashboard - reservations"}

{block name="dashboard_tabs_styles"}
{/block}

{block name="dashboard_content"}
<div class="container py-4">
    <div class="d-flex justify-content-center gap-3 mb-4">
        <button type="button" class="btn btn-secondary" onclick="window.location.href='/'">
            Torna alla Home
        </button>

        <button type="button" class="btn btn-primary" onclick="window.location.href='/dashboard/filteredList';">
            Filtra le prenotazioni
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center mx-auto" style="max-width: 900px;">
            <thead class="table-dark">
                <tr>
                    <th>Campo</th>
                    <th>Data</th>
                    <th>Orario</th>
                    <th>Utente</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                {foreach $reservations as $res}
                    <tr>
                        <td>{$res.field}</td>
                        <td>{$res.date}</td>
                        <td>{$res.time}</td>
                        <td>{$res.fullname}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="window.location.href='/reservation/reservationDetails?id={$res.id}'">
                                View details
                            </button>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>
{/block}