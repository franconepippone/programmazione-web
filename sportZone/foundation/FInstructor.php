<?php
require_once __DIR__ . "/../entity/EInstructor.php";

class FInstructor {

    public static function getAllInstructors() {
        return FEntityManager::getInstance()->selectAll(EInstructor::class);
    }
}
