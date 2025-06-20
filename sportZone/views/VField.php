<?php
require __DIR__ . '/../../vendor/autoload.php';

class VField{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showSearchForm() {
        $this->smarty->display("field/search_form.tpl");
    }

    public function showSearchResults() {
        $this->smarty->display("field/lista_campi.tpl");
    }
}