<?php

require __DIR__ . '/../../vendor/autoload.php';

use Smarty\Smarty;

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__ . '/../../sportZone/views/Smarty/templates/');
$smarty->setCompileDir(__DIR__ . '/../../sportZone/views/Smarty/templates_c/');
$smarty->setConfigDir(__DIR__ . '/../../sportZone/views/Smarty/configs/');
$smarty->setCacheDir(__DIR__ . '/../../sportZone/views/Smarty/cache/');

$smarty->assign('base_url', 'http://yourdomain.com');
$smarty->display('user/home.tpl');
