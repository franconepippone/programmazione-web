{* cancel_reservation.tpl *}

<h2>Cancellazione Prenotazione</h2>

{if isset($errorMessage)}
    <p style="color:red;">{$errorMessage}</p>
{else}

    <h3>Riepilogo Prenotazione</h3>

    <p><strong>ID Prenotazione:</strong> 
        {if $reservation neq null}
            {$reservation->getId()|default:'[getId()]'}
        {else}
            [getId()]
        {/if}
    </p>

    <p><strong>Data:</strong> 
        {if $reservation neq null && $reservation->getDate() neq null}
            {$reservation->getDate()|date_format:"%Y-%m-%d"}
        {else}
            [getDate()]
        {/if}
    </p>

    <p><strong>Orario:</strong> 
        {if $reservation neq null}
            {$reservation->getTime()|default:'[getTime()]'}
        {else}
            [getTime()]
        {/if}
    </p>

    {assign var=campo value=$reservation neq null ? $reservation->getField() : null}

    <p><strong>Campo Sportivo:</strong></p>
    <ul>
        <li>Sport: 
            {if $campo neq null}
                {$campo->getSport()|default:'[getSport()]'}
            {else}
                [getSport()]
            {/if}
        </li>
        <li>Tipo terreno: 
            {if $campo neq null}
                {$campo->getTipoTerreno()|default:'[getTipoTerreno()]'}
            {else}
                [getTipoTerreno()]
            {/if}
        </li>
        <li>Indoor: 
            {if $campo neq null}
                {if $campo->getIndoor() === null}
                    [getIndoor()]
                {elseif $campo->getIndoor()}
                    Indoor
                {else}
                    Outdoor
                {/if}
            {else}
                [getIndoor()]
            {/if}
        </li>
        <li>Costo Orario: 
            {if $campo neq null}
                {$campo->getCostoOrario()|default:'[getCostoOrario()]'} €
            {else}
                [getCostoOrario()]
            {/if}
        </li>
    </ul>

    <form method="post" action="/reservation/cancelReservation">
       <input type="hidden" name="id" value="{if $reservation neq null}{$reservation->getId()}{else}0{/if}">
       <button type="submit" name="confirm">Conferma cancellazione</button>
    </form>

{/if}
