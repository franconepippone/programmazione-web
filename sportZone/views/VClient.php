<?php
require __DIR__ . '/../../vendor/autoload.php';

class VClient{

    private $smarty;

    public function __construct() {
        $this->smarty = USmarty::getInstance();
    }

    public function showDashboardMyCourses(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/client/dashboard/courses.tpl');
    }

    public function showDashboardProfile(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/client/dashboard/profile.tpl');
    }

    public function showDashboarMyReservations(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/client/dashboard/reservations.tpl');
    }

    public function showDashboardSettings(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/client/dashboard/settings.tpl');
    }

}