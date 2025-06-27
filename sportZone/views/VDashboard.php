<?php
require __DIR__ . '/../../vendor/autoload.php';

class VDashboard{

    private $smarty;

    public function __construct() {
        $this->smarty = USmarty::getInstance();
    }

    private function getBasePath(string $role): string {
        switch ($role) {
            case EClient::class: return "user/client/dashboard/";
            case EInstructor::class: return "user/instructor/dashboard/";
            case EEmployee::class: return "user/employee/dashboard/";
            default: return "";
        }
    }


    public function showMyCourses($mycourses , $user , $role) {
        //$userArray = EUser::usertoArray($user);

        $coursesData = [];
        foreach ($mycourses as $course) {
            $coursesData []= ECourse::courseToArray($course);
        }

        $this->smarty->assign('courses', $coursesData);
        

        USmarty::configureBaseLayout($this->smarty);
  
        $this->smarty->display($this->getBasePath($role) . 'myCourses.tpl');
    }





    public function showDashboardProfile(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'profile.tpl');

    }

    public function showDashboarMyReservations(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'reservations.tpl');
    }

    public function showDashboardSettings(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'settings.tpl');
    }

    // -------------- EMPLOYEE ONLY -----------------

    public function showManageCourses(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'mng_courses.tpl');
    }

    public function showManageFields(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'mng_fields.tpl');
    }

    public function showManageReservations(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'mng_reservations.tpl');
    }

    public function showManageUsers(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'mng_users.tpl');
    }

}