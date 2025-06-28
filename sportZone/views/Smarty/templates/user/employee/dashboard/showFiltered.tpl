{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageReservations"}

{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="dashboard_content"}
    <div class="form-wrapper">
        <h2>🔍 Prenotazioni filtrate</h2>

        <form method="get" action="/dashboard/filteredList">
            <div class="form-group">
                <label for="name">Nome utente:</label>
                <input type="text" id="name" name="name" value="{$name|default:''}">
            </div>

            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" id="date" name="date" value="{$date|default:''}">
            </div>

            <div class="form-group">
                <label for="sport">Sport:</label>
                <input type="text" id="sport" name="sport" value="{$sport|default:''}">
            </div>

            <button type="submit" class="submit-button">Filtra</button>
        </form>

        <hr style="margin: 2rem 0;">

        <table>
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
                            <button type="button" class="submit-button" 
                                onclick="window.location.href='/reservation/reservationDetails?id={$res.id}'">
                                View details
                            </button>
                        </td>
                    </tr>
                {foreachelse}
                    <tr><td colspan="5" style="text-align:center;">Nessuna prenotazione trovata</td></tr>
                {/foreach}
            </tbody>
        </table>

        <div style="text-align:center; margin-top: 20px;">
            <button type="button" class="submit-button" onclick="window.location.href='/'">Torna alla Home</button>
        </div>
    </div>
{/block}