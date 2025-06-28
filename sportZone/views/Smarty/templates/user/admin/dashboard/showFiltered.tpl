{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageReservations"}
{assign var="page_title" value="Dashboard - Settings"}

{block name="dashboard_content"}
    <div class="container py-4" style="max-width: 900px;">
        <h2 class="mb-4">Cerca prenotazioni</h2>

        <form method="get" action="/dashboard/manageReservations" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="name" class="form-label">Nome utente:</label>
                <input type="text" id="name" name="name" value="{$name|default:''}" class="form-control">
            </div>

            <div class="col-md-4">
                <label for="date" class="form-label">Data:</label>
                <input type="date" id="date" name="date" value="{$date|default:''}" class="form-control">
            </div>

            <div class="col-md-4">
                <label for="sport" class="form-label">Sport:</label>
                <input type="text" id="sport" name="sport" value="{$sport|default:''}" class="form-control">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Filtra</button>
            </div>
        </form>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
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
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="window.location.href='/reservation/reservationDetails?id={$res.id}'">
                                    View details
                                </button>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="5" class="text-center">Nessuna prenotazione trovata</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='/'">Torna alla Home</button>
        </div>
    </div>
{/block}