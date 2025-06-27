<?php
require __DIR__ . '/../../vendor/autoload.php';

class VInstructor{

    private $smarty;

    public function __construct() {
        $this->smarty = USmarty::getInstance();
    }

    public function showDashboardMyCourses(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/instructor/dashboard/courses.tpl');
    }

    public function showDashboardProfile(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/instructor/dashboard/profile.tpl');
    }

    public function showDashboarMyReservations(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/instructor/dashboard/reservations.tpl');
    }

    public function showDashboardSettings(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/instructor/dashboard/settings.tpl');
    }

}