{* filepath: c:\xampp\htdocs\programmazione-web\sportZone\views\Smarty\templates\reservation\my_reservations.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Le mie prenotazioni</title>
</head>
<body>
    <h2>Le mie prenotazioni</h2>
    {if $reservations|@count > 0}
        <table>
            <tr>
                <th>Campo</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Azioni</th>
            </tr>
            {foreach $reservations as $reservation}
                <tr>
                    <td>{$reservation.field_name}</td>
                    <td>{$reservation.date}</td>
                    <td>{$reservation.time}</td>
                    <td>
                        <form method="post" action="index.php?controller=reservation&action=cancelReservation">
                            <input type="hidden" name="id" value="{$reservation.id}">
                            <button type="submit">Cancella</button>
                        </form>
                    </td>
                </tr>
            {/foreach}
        </table>
    {else}
        <p>Nessuna prenotazione trovata.</p>
    {/if}
    <a href="/user/home">Torna alla Home</a>
</body>
</html>