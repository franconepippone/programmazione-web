{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="manageReservations"}

{block name="dashboard_tabs_styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="dashboard_content"}
        <div style="display: flex; justify-content: center; gap: 2rem; margin-top: 2rem;">
            <button type="button" class="submit-button" onclick="window.location.href='/'">
                Torna alla Home
            </button>

            <button class="submit-button" type="button" onclick="window.location.href='/dashboard/filteredList';">
                Filtra le prenotazioni
            </button>
        </div>
        <table style="margin: 0 auto; margin-top: 3rem;; width: 100%; max-width: 900px;">
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
        {/foreach}
    </tbody>
</table>


        
    </div>
{/block}
