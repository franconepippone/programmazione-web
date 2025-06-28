{block name="styles"}
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/form.css">
{/block}

{block name="content"}
       <div class="form-wrapper" style="max-width: 400px;">
        <h2>Dettaglio Prenotazione</h2>
        <div class="reservation-details">
            <ul>
                <li><b>ID:</b> {$reservation.id}</li>
                <li><b>Data:</b> {$reservation.date}</li>
                <li><b>Ora:</b> {$reservation.time}</li>
                <li><b>Campo:</b> {$reservation.field}</li>
                <li><b>Utente:</b> {$reservation.fullname}</li>
                <li><b>Costo:</b> €{$reservation.cost|number_format:2}</li>
                <li><b>Metodo di pagamento:</b> {$reservation.paymentMethod}</li>
                {if isset($reservation.otherInfo)}
                    <li><b>Altre info:</b> {$reservation.otherInfo}</li>
                {/if}
            </ul>
            <div class="button-container" style="display:flex; justify-content:center; gap:1rem; margin-top:20px;">
                <button type="button" class="submit-button" onclick="window.history.back()">Torna indietro</button>
                </form>
                <form action="/reservation/modifyReservation" method="get" style="margin:0;">
                    <input type="hidden" name="id" value="{$reservation.id}">
                    <button type="submit" class="submit-button">Modifica</button>
                </form>
                <form action="/reservation/cancelReservation" method="get" style="margin:0;">
                    <input type="hidden" name="id" value="{$reservation.id}">
                    <button type="submit" class="submit-button" style="background: linear-gradient(135deg, #f44336, #d32f2f); box-shadow: 0 4px 10px rgba(244, 67, 54, 0.4);">
                        Cancella
                    </button>
                </form>
            </div>
        </div>
    </div>
{/block}