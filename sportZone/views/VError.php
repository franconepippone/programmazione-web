<?php
require __DIR__ . '/../../vendor/autoload.php';

class VReservation{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public static function show(string $message) {
        $smarty = self::getSmarty();
        $smarty->assign("errorMessage", $message);
        $smarty->display("error/error.tpl");
        exit; // Stop further execution after showing error
    }
}
