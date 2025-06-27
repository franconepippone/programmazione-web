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

    public function showDashboardMyCourses(array $courses, string $role) {
        //$userArray = EUser::usertoArray($user);

        $coursesData = [];
        foreach ($courses as $course) {
            $coursesData []= ECourse::courseToArray($course);
        }

        $this->smarty->assign('courses', $coursesData);
        $this->smarty->assign('userRole', $role);

        USmarty::configureBaseLayout($this->smarty);
        //$this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'courses.tpl');
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

    public function showManageUsers(EUser $user, string $role) {
        $userArray = EUser::usertoArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'mng_users.tpl');
    }

    public function showManageReservations(array $reservations, string $role) {
        $reservationsArray = [];
        foreach ($reservations as $reservation) {
            $reservationsArray[] = EReservation::reservationToArray($reservation);
        }
        $this->smarty->assign('reservations', $reservationsArray);


        USmarty::configureBaseLayout($this->smarty);
        //$this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'mng_reservations.tpl');
    }

    // -------------- CLIENT ONLY -----------------
      public function showMyReservationDetails($reservation, $active, $role) {
        
        $reservationArray = EReservation::reservationToArray($reservation);
        $this->smarty->assign('reservation', $reservationArray);
        $this->smarty->assign('active', $active);


        USmarty::configureBaseLayout($this->smarty);
        //$this->smarty->assign('user', $userArray);
        $this->smarty->display($this->getBasePath($role) . 'reservations.tpl');
    }

}