{block name="styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/styleform.css">
   
{/block}

{block name="content"}
    <div class="form-wrapper">
        <h2>Prenotazione Confermata</h2>
        <p>La tua prenotazione è stata registrata con successo.</p>

        {if isset($reservation)}
            <h3>Dettagli Prenotazione</h3>
            <ul class="form-group">
                <li><strong>Data:</strong> {$reservation->getDate()|default:'[data non disponibile]'}</li>
                <li><strong>Orario:</strong> {$reservation->getTime()|default:'[orario non disponibile]'}</li>
                <li><strong>Campo:</strong>
                    {if $reservation->getField() != null}
                        {$reservation->getField()->getSport()} - {$reservation->getField()->getTipoTerreno()}
                    {else}
                        [campo non disponibile]
                    {/if}
                </li>
                <li><strong>Metodo di pagamento:</strong>
                    {if $reservation->getPayment() != null}
                        {$reservation->getPayment()->getType()}
                    {else}
                        [non specificato]
                    {/if}
                </li>
            </ul>
        {/if}

        <form method="post" action="/user/home" class="form-group">
            <button type="submit" class="submit-button">← Torna alla home</button>
        </form>
    </div>
{/block}