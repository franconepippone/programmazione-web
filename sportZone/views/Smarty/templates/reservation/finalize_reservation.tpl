<h2>Riepilogo Prenotazione</h2>

<p><strong>Data:</strong> {$data|default:'[data non disponibile]'}</p>
<p><strong>Orario:</strong> {$orario|default:'[orario non disponibile]'}</p>

<h3>Informazioni Campo</h3>
{if $campo != null}
    <ul>
        <li><strong>Sport:</strong> {$campo->getSport()|default:'[getSport()]'}</li>
        <li><strong>Tipo terreno:</strong> {$campo->getTipoTerreno()|default:'[getTipoTerreno()]'}</li>
        <li><strong>Indoor:</strong>
            {if $campo->getIndoor() === null}[getIndoor()]
            {elseif $campo->getIndoor()}Indoor
            {else}Outdoor
            {/if}
        </li>
        <li><strong>Costo orario:</strong> {$campo->getCostoOrario()|default:'[getCostoOrario()]'} €</li>
    </ul>
{else}
    <p><em>Campo non disponibile (metodi: getSport(), getTipoTerreno(), ecc.)</em></p>
{/if}

<form id="reservationForm" method="post" action="index.php?controller=reservation&task=finalizeReservation">
    <input type="hidden" name="data" value="{$data|default:''}">
    <input type="hidden" name="orario" value="{$orario|default:''}">
    <input type="hidden" name="id" value="{$campo->getId()|default:''}">

    <label for="paymentMethod">Metodo di pagamento:</label>
    <select name="paymentMethod" id="paymentMethod" required>
        <option value="onsite">Pagamento in loco</option>
        <option value="online">Pagamento online</option>
    </select>

    <br><br>
    <button type="submit" name="confirm">Conferma Prenotazione</button>
</form>

<script>
    document.getElementById('reservationForm').addEventListener('submit', function (e) {
        const metodo = document.getElementById('paymentMethod').value;
        if (metodo === 'online') {
            this.action = 'index.php?controller=onlinepayment&task=payForm';
        }
    });
</script>
