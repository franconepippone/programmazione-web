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

    /*
    Array of entries if this kind
    [
            'id'  => 5,  
            'title' => 'Campo Volley Beach',
            'sport' => 'Beach Volley',
            'orario' => '10:00 - 19:00',
            'superficie' => 'Sabbia',
            'price' => '€30 / ora',
            'url' => 'campo5.html',
            'image' => 'https://www.happy-family.it/wp-content/uploads/2020/10/happy-familyjpg9.jpg',
            'alt' => 'Campo Volley Beach'
        ]
    */
    public function showSearchResults($fields) {
        $this->smarty->assign('fields', $fields);
        $this->smarty->display("field/search_results_list.tpl");
    }

    // ------------------- ADMIN -----------------------------

    public function showCreateFieldForm() {
        $this->smarty->display("field/create_field.tpl");
    }

}