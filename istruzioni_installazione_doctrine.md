# Installazione Doctrine con composer.phar
Una volta pullato tutto dovreste avere nella repository i seguenti file

- composer.json
- composer.lock
- composer.phar

Prima di tutto dovete avere installato git. Per verificare che lo avete installato, provate ad aprire il terminale e digitare:
> git --version

Se non da errore allora git è installato, altrimenti dovrete installarlo da qui: https://git-scm.com/downloads/win. <br>
Una volta installato riavviate VSCode o il terminale prima di procedere.

Doctrine non è installato ancora, per farlo dovete eseguire il seguente comando da terminale (assicuratevi di aprire il terminale
nella cartella dove avete clonato la repository!!)

> php composer.phar install

Se "php" non viene riconosciuto, allora provate questo comando:

> C:\xampp\php\php.exe composer.phar install

Questo installerà automaticamente tutto ciò specificato dal file composer.json, tra cui Doctrine.
E' normale se sul terminale vi escono cose colorate che sembrano errori, ci mette un po' ad installare tutto. Se comunque ottenete degli errori durante l'installazione provate a disattivare l'Antivirus o firewall, a me ha funzionato.

Alla fine verificate che sia stata creata la cartella vendor\, e che dentro ci siano le cartelle \doctrine e \symfony.
Dovrebbe funzionare tutto a questo punto.