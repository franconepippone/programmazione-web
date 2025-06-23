<?php
require_once __DIR__ . "/../entity/EInstructor.php";

class FInstructor {

    public static function getallInstructor(): ?EClient {
        return FEntityManager::getInstance()->getallObj(EInstructor::class);
    }
