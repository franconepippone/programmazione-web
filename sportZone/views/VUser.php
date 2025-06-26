<?php
require __DIR__ . '/../../vendor/autoload.php';

class VUser{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showLoginForm(string $redirectUrl) {
        $this->smarty->assign("redirectUrl", $redirectUrl);
        $this->smarty->display("user/login.tpl");
    }

    public function showRegistrationForm() {
        $this->smarty->display("user/register.tpl");
    }

    public function showDashboardMyCourses(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        $this->chooseLayout(true);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/dashboard/courses.tpl');
    }

    public function showDashboardProfile(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        $this->chooseLayout(true);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/dashboard/profile.tpl');
    }

    public function showDashboarMyReservations(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        $this->chooseLayout(true);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/dashboard/reservations.tpl');
    }

    public function showDashboardSettings(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);
        
        $this->chooseLayout(true);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display('user/dashboard/settings.tpl');
    }

    public function showHome($logged) {
        $this->chooseLayout($logged);
        $this->smarty->display('user/home.tpl');
    }

    private function chooseLayout($logged) {
        $this->smarty->assign('layout', !$logged ? 
        'sportZone/views/Smarty/templates/layouts/guest_base.tpl' : 'sportZone/views/Smarty/templates/layouts/logged_base.tpl');
    }

}