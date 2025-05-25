<?php

require_once __DIR__ . "/../../sportZone/foundation/FEntityManager.php";
foreach (glob(__DIR__ . "/../../sportZone/entity/E*.php") as $file) {
    require_once $file;
}

require_once __DIR__ . "/../../sportZone/entity/enums/sesso_enum.php";
use App\Enum\SessoEnum;


$fem = FEntityManager::getInstance();

$cliente = new ECliente(
    'Argildo',                   // $nome
    'Escuculo',                   // $cognome
    new DateTime('2002-05-5'), // $data_nascita
    SessoEnum::TRANS,           // $sesso
    'pino.esposito200@example.com', // $email
    'porcaccioddio2',                  // $nome_utente
    '12345'        // $password
);

echo "salvando...\n";
$fem->saveObject($cliente);
echo "Oggetto salvato\n";

$cliente_retr = $fem->retriveObj(ECliente::class, 2);
echo "oggetto recuperato, id: ". $cliente_retr->getId();
echo $cliente_retr->getNome();
echo $cliente_retr->getCognome();
echo $cliente_retr->getEmail();
