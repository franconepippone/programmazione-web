<?php
require_once __DIR__ . "/../entity/EClient.php";

class FClient {

    /**
     * Retrieve a Client by ID
     *
     * @param int $id
     * @return EClient|null
     */
    public static function getClientById(int $id): ?EClient {
        return FEntityManager::getInstance()->retriveObj(EClient::class, $id);
    }

    public static function getAllClients() {
        return FEntityManager::getInstance()->selectAll(EClient::class);
    }
}
