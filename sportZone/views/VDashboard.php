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




   // -------------- INSTRUCTOR ONLY ----------------------------
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


    public function showDetailsInstrcutor( $course , $enrollments ,$user , $role)
    {
       // echo var_dump($enrollmentsData);
       if ($course === null) {
            (new VError())->show("Corso non trovato.");
            return;
        }
        $courseData = [];
        $enrollmentsData = [];
        $courseData [] = ECourse::courseToArray($course);

        if (sizeof($enrollments)>0){
            foreach($enrollments as $enrolled){
                $client = $enrolled->getClient();
                $enrollmentsData []= EUser::usertoArray($client);
                
            }
        }
        $this->smarty->assign('courses', $courseData);
        $this->smarty->assign('enrollments', $enrollmentsData);
        USmarty::configureBaseLayout($this->smarty);
  
        $this->smarty->display($this->getBasePath($role) . 'courseDetailsInstructor.tpl');
        //$this->smarty->display('course/courseDetailsInstructor.tpl');
        
    }
    // -------------- CLIENT ONLY ---------------------------
    public function showMyEnrollments($enrollments, $user, $role)
    {
        $enrollmentsData = [];
        foreach ($enrollments as $enrollment) {
            $enrollmentsData[] = EEnrollment::enrollmentToArray($enrollment);
        }
        $this->smarty->assign('enrollments', $enrollmentsData);
        
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display($this->getBasePath($role) . 'myEnrollments.tpl');
        
    }

    public function showDetailsClient($course, $user , $role)
    {
        // Controlla se il corso è stato trovato
        if ($course === null) {
            (new VError())->show("Corso non trovato.");
            return;
        }
        $courseData = [];
    
        $courseData [] = ECourse::courseToArray($course);

        $this->smarty->assign('courses', $courseData);
        USmarty::configureBaseLayout($this->smarty);
  
        $this->smarty->display($this->getBasePath($role) . 'courseDetailsClient.tpl');

        //$this->smarty->display('course/courseDetailsClient.tpl');
    
    }
    //********************************************************* */
    


   

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

    public function showFilteredReservations($reservations, $name, $date, $sport, $role) {
        
        $reservationsArray = [];
        foreach ($reservations as $reservation) {
            $reservationsArray[] = EReservation::reservationToArray($reservation);
        }
        $this->smarty->assign('reservations', $reservationsArray);

        $this->smarty->assign('name', $name ?? '');
        $this->smarty->assign('date', $date ?? '');
        $this->smarty->assign('sport', $sport ?? '');
        
        USmarty::configureBaseLayout($this->smarty);
       
        $this->smarty->display($this->getBasePath($role) . 'showFiltered.tpl');
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