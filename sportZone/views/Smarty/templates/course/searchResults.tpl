<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Elenco Corsi</title>
    <link rel="stylesheet" href="stile_corsi.css">
</head>
<body>

    <h1 id="titolo-pagina">Elenco dei Corsi Disponibili</h1>

    <div id="corsi-container">
        {foreach from=$corsi item=corso}
            <div class="corso-card">
                <img class="corso-immagine" src="{$corso.immagine}" alt="Immagine del corso: {$corso.nome}">
                <div class="corso-dettagli">
                    <h2 class="corso-nome">{$corso.nome|escape}</h2>
                    <p class="corso-date">
                        Dal {$corso.data_inizio|date_format:"%d/%m/%Y"} al {$corso.data_fine|date_format:"%d/%m/%Y"}
                    </p>
                </div>
            </div>
        {/foreach}
    </div>

</body>
</html>

