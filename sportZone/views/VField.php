<?php
require __DIR__ . '/../../vendor/autoload.php';

class VField{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showSearchForm() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('default_date', date('Y-m-d', strtotime('+7 days')));
        $this->smarty->display("field/search_form.tpl");
    }


    public function showSearchResults($fields, $query, $searchParams) {
        $fieldsInfo = [];
        foreach ($fields as $fld) {
            $fieldsInfo[] = EField::fieldToArray($fld);
        }

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('queryString', $query);
        $this->smarty->assign('search', $searchParams);
        $this->smarty->assign('fields', $fieldsInfo);
        $this->smarty->display("field/search_results_list.tpl");
    }

    public function showDetailsPage($field, $date) {

        $fieldArray = EField::fieldToArray($field);

          // Passa i dati a Smarty
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('field', $fieldArray);
        $this->smarty->assign('choosenDate', $date);
        $this->smarty->display("field/field_details.tpl");
    }

    // ------------------- ADMIN -----------------------------

    public function showCreateFieldForm() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display("field/create_field_form.tpl");
    }

    public function showModifyFieldForm($field, $images) {

        $fieldArray = EField::fieldToArray($field);
        
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('images', $images);
        $this->smarty->assign('field', $fieldArray);
        $this->smarty->display("field/modify_field_form.tpl");
    }


}