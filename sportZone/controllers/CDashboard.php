<?php


require_once __DIR__ . "/../../vendor/autoload.php";

class CDashboard{

    private static function assertRole(...$allowedRoles): string {
        $role = CUser::getUserRole();
        if (!in_array($role, $allowedRoles, true)) {
            $verr = new VError();
            $verr->show("You have no access to this page.");
            exit;
        }
        return $role;
    }

    // ----------------- COMMON --------------------

    public static function profile(){
        CUser::isLogged();
        $role = self::assertRole(EEmployee::class, EClient::class, EInstructor::class);

        $view = new VDashboard();
        $user = CUser::getLoggedUser();
        $view->showDashboardProfile($user, $role);
    
    }

    public static function settings(){
        CUser::isLogged();
        $role = self::assertRole(EEmployee::class, EClient::class, EInstructor::class);

        $view = new VDashboard();
        $user = CUser::getLoggedUser();
        $view->showDashboardSettings($user, $role);
    
    }

    // ---------------- CLIENT ONLY --------------------------- 

    

     public static function myReservations() {
        
        CUser::isLogged();
        $role = self::assertRole(EClient::class);

        //$clientId = CUser::getCurrentUser()->getId();
        $clientId = $_SESSION['user'];
        $reservation = FPersistentManager::getInstance()->retriveActiveReservationByUserId($clientId);
        $active = $reservation !== null;

        $view = new VDashboard();

        $view->showMyReservationDetails($reservation, $active, CUser::getUserRole());

    }



    // ----------------- CLIENT & INSTRUCTOR ONLY -----------------------
    
    public static function _myCourses(){
        CUser::isLogged();
        $role = self::assertRole(EClient::class, EInstructor::class);
    }
    public static function myEnrollments()
    {
        
        $role = self::assertRole(EClient::class);
        $user = CUser::getLoggedUser();
        $userId = $user->getId();
        $enrollments = FPersistentManager::getInstance()->retriveEnrollmentsOnUserId($userId);

        $view = new VDashboard();
        $view->showMyEnrollments($enrollments, $user, $role);
    }

     public static function courseDetailsClient($course_id) {
        $user = CUser::getLoggedUser();
        
        
        $role = self::assertRole(EClient::class);
        $course = FPersistentManager::retriveCourseOnId($course_id);
        
       
        //echo $enrollments[0]->getDate();
       
    
        
        $view = new VDashboard();
        $view->showDetailsClient( $course ,$user , $role);
    }
    

    // ----------------- INSTRUCTOR ONLY -----------------------

    public static function myCourses(){
        
        $user = CUser::getLoggedUser();
        $role = self::assertRole(EInstructor::class);
        
        $mycourses= FPersistentManager::getInstance()->retriveCoursesOnInstructorId($user->getId());

        // Mostra la vista di gestione corsi istruttore
        $view = new VDashboard();
        $view->showMyCourses($mycourses, $user, $role,);
    }


    public static function courseDetailsInstructor($course_id) {
        $user = CUser::getLoggedUser();
       
        $role = self::assertRole(EInstructor::class);
        
        $course = FPersistentManager::retriveCourseOnId($course_id);
        
        $enrollments = FPersistentManager::retriveEnrollmentsOnCourseId($course_id);
        //echo $enrollments[0]->getDate();
       
    
        
        $view = new VDashboard();
        $view->showDetailsInstrcutor( $course , $enrollments,  $user, $role);
    }

   

    // --------------- EMPLOYEE ONLY -----------------

    public static function manageCourses(){
        $user = CUser::getLoggedUser();
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();
        $view->showManageCourses($user, $role);
    }

    public static function manageFields(){
        $user = CUser::getLoggedUser();
        $role = self::assertRole(EEmployee::class);
        
        $rulesSearch = [
            "sport" => "validateSport"
        ];

        try {
            $getInputs = UValidate::validateInputArray($_GET, $rulesSearch, false);
        } catch (ValidationException $e) {
            echo "INPUT VALIDATION FAILED: " . $e->getMessage();
            exit;
        }

        $searchParams = ['sport' => ''];
        if (isset($getInputs['sport'])) {
            $searchParams['sport'] = $getInputs['sport'];
        }

        // filtraggio campi

        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveAllMatchingFields();

    
        $view = new VDashboard();
        $view->showManageFields($user, $role, $fields, $searchParams);
    }
/*
    public static function manageReservations(){
        
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageReservations($user, $role);
    }
*/
    public static function manageUsers(){
     
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageUsers($user, $role);
    }
    
    public static function manageReservations() {

        $role = self::assertRole(EEmployee::class);
        $view = new VDashboard();
        $user = CUser::getLoggedUser();
        
        $reservations = FPersistentManager::getInstance()->retriveAllReservations();
        
        $view->showManageReservations($reservations, $role);
    }
}
