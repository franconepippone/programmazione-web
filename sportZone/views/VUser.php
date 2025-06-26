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

    public function showDashboardMyCourses(string $username) {
        $this->smarty->assign('username', $username);
        $this->smarty->display('user/home/tabs/courses.tpl');
    }

    public function showDashboardProfile(string $username) {
        $this->smarty->assign('user', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'gender' => 'male',
            'age' => 30,
            'phone' => '123-456-7890'
        ]);
        $this->smarty->display('user/home/tabs/profile.tpl');
    }

    public function showDashboarMyReservations(string $username) {
        $this->smarty->assign('username', $username);
        $this->smarty->display('user/home/tabs/reservations.tpl');
    }

    public function showDashboardSettings(string $username) {
        $this->smarty->assign('username', $username);
        $this->smarty->display('user/home/tabs/settings.tpl');
    }

}