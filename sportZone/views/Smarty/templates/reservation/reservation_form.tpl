<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Prenotazione Campo (Test)</title>
  <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/styleform.css" />
</head>
<body>

  <div class="container">

    <h2>Prenotazione Campo</h2>
    <form method="POST" action="/reservation/reservationSummary">
    <div>
        <b>Campo:</b> {$fieldData.sport} - {$fieldData.terrainType}
    </div>
    <div>
        <b>Data:</b> {$date}
    </div>
    <div>
        <label for="time">Orario:</label>
        <select name="time" id="time" required>
            {foreach $avaiableHours as $hour}
                <option value="{$hour}">{$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}</option>
            {/foreach}
        </select>
    </div>
    <input type="hidden" name="field_id" value="{$fieldData.id}">
    <input type="hidden" name="date" value="{$date}">
    <button type="submit">Prosegui</button>
    <button type="button" onclick="window.history.back()">Torna indietro</button>
</form>
  </div>

</body>
</html>
