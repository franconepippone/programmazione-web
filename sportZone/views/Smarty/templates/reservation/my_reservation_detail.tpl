{* filepath: c:\xampp\htdocs\programmazione-web\sportZone\views\Smarty\templates\reservation\my_reservations.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <title>La tua prenotazione attiva</title>
</head>
<body>
    <h2>La tua prenotazione attiva</h2>
    <ul>
        <li><b>Campo:</b> {$reservation.field}</li>
        <li><b>Data:</b> {$reservation.date}</li>
        <li><b>Ora:</b> {$reservation.time}</li>
        <!-- Altri dettagli se vuoi -->
    </ul>
    <form method="post" action="/reservation/cancelInfo">
        <button type="submit">Cancella prenotazione</button>
    </form>
    <form method="post" action="/user/home">
        <button type="submit">Torna alla homepage</button>
    </form>
</body>
</html>