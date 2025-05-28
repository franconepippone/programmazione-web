<?php

require 'vendor/autoload.php';

$smarty = new Smarty();

$smarty->assign('name', 'World');
$smarty->display('index.tpl');
