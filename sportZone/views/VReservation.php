<?php
require __DIR__ . '/../../vendor/autoload.php';

class VReservation{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showCreateForm() {
        $this->smarty->display("reservation/create_form.tpl");
    }
}
