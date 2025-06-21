{* cancel_reservation.tpl *}

<h2>Cancellazione Prenotazione</h2>

{if isset($errorMessage)}
    <p style="color:red;">{$errorMessage}</p>
{else}
    <h3>Riepilogo Prenotazione</h3>

    <p><strong>ID Prenotazione:</strong> {$reservation->getId()|default:'[getId()]'}</p>
    <p><strong>Data:</strong> 
        {if $reservation->getDate() neq null}
            {$reservation->getDate()|date_format:"%Y-%m-%d"}
        {else}
            [getDate()]
        {/if}
    </p>
    <p><strong>Orario:</strong> {$reservation->getTime()|default:'[getTime()]'}</p>

    {assign var=campo value=$reservation->getField()}
    {if $campo}
        <p><strong>Campo Sportivo:</strong></p>
        <ul>
            <li>Sport: {$campo->getSport()|default:'[getSport()]'}</li>
            <li>Tipo terreno: {$campo->getTipoTerreno()|default:'[getTipoTerreno()]'}</li>
            <li>Indoor: 
                {if $campo->getIndoor() === null}
                    [getIndoor()]
                {elseif $campo->getIndoor()}
                    Indoor
                {else}
                    Outdoor
                {/if}
            </li>
            <li>Costo Orario: {$campo->getCostoOrario()|default:'[getCostoOrario()]'} €</li>
        </ul>
    {else}
        <p><em>Informazioni campo non disponibili (metodi: getSport(), getTipoTerreno(), ecc.)</em></p>
    {/if}

    <form method="post" action="index.php?controller=reservation&task=cancelReservation&id={$reservation->getId()|default:''}">
        <button type="submit" name="confirm">Conferma cancellazione</button>
    </form>
{/if}
