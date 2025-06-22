<?php

class VError
{
    private $smarty;
    public function __construct()
    {
        $this->smarty = USmarty::getInstance();
    }
    public function showError($errorMessage)
    {
        $this->smarty->assign('errorMessage', $errorMessage);
        $this->smarty->display('error/error.tpl');
    }

}