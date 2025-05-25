<?php

require_once __DIR__ . "/../../sportZone/foundation/FEntityManager.php";
foreach (glob(__DIR__ . "/../../sportZone/entity/E*.php") as $file) {
    require_once $file;
}

require_once __DIR__ . "/../../sportZone/entity/enums/sesso_enum.php";
use App\Enum\SessoEnum;


$fem = FEntityManager::getInstance();

$cliente = new ECliente(
    'Mario',                   // $nome
    'Rossi',                   // $cognome
    new DateTime('1990-05-01'), // $data_nascita
    SessoEnum::MALE,           // $sesso
    'mario.rossi@example.com', // $email
    'mrossi',                  // $nome_utente
    'securepassword123'        // $password
);

echo "salvando...\n";
$fem->saveObject($cliente);
echo "Oggetto salvato\n";

$cliente_retr = $fem->retriveObj(ECliente::class, 1);
echo "oggetto recuperato, id: ". $cliente_retr->getId();
echo $cliente_retr->getNome();