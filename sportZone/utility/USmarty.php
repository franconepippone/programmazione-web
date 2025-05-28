<?php
require __DIR__ ."/../../vendor/autoload.php";

use Smarty\Smarty;

class USmarty{

    // returns a Smarty instance already configured and ready to use
    static function getInstance(){
        $smarty=new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../sportZone/views/Smarty/templates/');
        $smarty->setCompileDir(__DIR__ . '/../../sportZone/views/Smarty/templates_c/');
        $smarty->setConfigDir(__DIR__ . '/../../sportZone/views/Smarty/configs/');
        $smarty->setCacheDir(__DIR__ . '/../../sportZone/views/Smarty/cache/');
        return $smarty;
    }
}