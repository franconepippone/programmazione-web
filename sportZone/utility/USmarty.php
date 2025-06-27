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

    // chooses which base layout to use based on a few factors,
    // and assigns base template variables
    public static function configureBaseLayout($smarty) {
        $logged = CUser::isLoggedBool();
        $smarty->assign("layout", !$logged ? 
            'sportZone/views/Smarty/templates/layouts/guest_base.tpl' : 
            'sportZone/views/Smarty/templates/layouts/logged_base.tpl');

        // this querty is used in all the buttons redirecting to login,
        $smarty->assign("loginQueryString", http_build_query([
            'redirect' => $_SERVER['REQUEST_URI']
        ]));
        
    }
}