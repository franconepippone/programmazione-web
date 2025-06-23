<?php
require_once __DIR__ . "/../entity/ECourse.php";

class FCourse {

  public static function saveCourse(ECourse $course): void {
        FEntityManager::getInstance()->save($course);
    }
}
