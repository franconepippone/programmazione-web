<?php

use App\Enum\EnumSport;


require_once __DIR__ . "/../../vendor/autoload.php";

class CDashboard{
    private static function assertRole(...$allowedRoles): string {
        return CUser::assertRole(...$allowedRoles);
    }

    // ----------------- COMMON --------------------

    public static function profile(){
        CUser::isLogged();
        $role = self::assertRole(EEmployee::class, EClient::class, EInstructor::class, EAdmin::class);

        if ($role === EAdmin::class) header("Location: /dashboard/manageFields");

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

        $clientId = $_SESSION['user'];
        $reservation = UUtility::retriveActiveReservationByUserId($clientId);
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
        CUser::isLogged();
        $role = self::assertRole(EClient::class);
        $user = CUser::getLoggedUser();
        $userId = $user->getId();
        $enrollments = FPersistentManager::getInstance()->retriveEnrollmentsOnUserId($userId);

        $view = new VDashboard();
        $view->showMyEnrollments($enrollments, $user, $role);
    }

     public static function courseDetailsClient($course_id) {
        CUser::isLogged();
        $user = CUser::getLoggedUser();
        
        
        $role = self::assertRole(EClient::class);
        $course = FPersistentManager::retriveCourseOnId($course_id);
        
       
        //echo $enrollments[0]->getDate();
       
    
        
        $view = new VDashboard();
        $view->showDetailsClient( $course ,$user , $role);
    }
    

    // ----------------- INSTRUCTOR ONLY -----------------------

    public static function myCourses(){
        CUser::isLogged();
        $user = CUser::getLoggedUser();
        $role = self::assertRole(EInstructor::class);
        
        $mycourses= FPersistentManager::getInstance()->retriveCoursesOnInstructorId($user->getId());

        // Mostra la vista di gestione corsi istruttore
        $view = new VDashboard();
        $view->showMyCourses($mycourses, $user, $role);
    }


    public static function courseDetailsInstructor($course_id) {
        CUser::isLogged();
        $user = CUser::getLoggedUser();
       
        $role = self::assertRole(EInstructor::class);
        
        $course = FPersistentManager::retriveCourseOnId($course_id);
        
        $enrollments = FPersistentManager::retriveEnrollmentsOnCourseId($course_id);
        //echo $enrollments[0]->getDate();
       
    
        
        $view = new VDashboard();
        $view->showDetailsInstrcutor( $course , $enrollments,  $user, $role);
    }

   

    // --------------- EMPLOYEE ONLY -----------------

    // Function to show the list of courses
    // It retrieves the courses from the persistent manager and displays them using the view
    public static function manageCourses() {  
        $user = CUser::getLoggedUser();
        $role = self::assertRole(EEmployee::class);
           
        try {       
                $courses = FPersistentManager::getInstance()->retriveCourses();               
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        }        

        $view = new VDashboard();
        $view->showCourses($courses, $role);
        
    }

    public static function manageFields(){
        CUser::isLogged();
        $user = CUser::getLoggedUser();
        $role = self::assertRole(EEmployee::class, EAdmin::class);
        
        $rulesSearch = [
            "sport" => "validateSport"
        ];

        try {
            $getInputs = UValidate::validateInputArray($_GET, $rulesSearch, false);
        } catch (ValidationException $e) {
            echo "INPUT VALIDATION FAILED: " . $e->getMessage();
            exit;
        }

        $searchParams = ['sport' => null];
        if (isset($getInputs['sport'])) {
            $searchParams['sport'] = $getInputs['sport'];
        }

        // filtraggio campi

        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveFieldsBySport($searchParams['sport']);

    
        $view = new VDashboard();
        $view->showManageFields($user, $role, $fields, $searchParams);
    }


    
    
    public static function manageReservations() {
        CUser::isLogged();
        $role = self::assertRole(EEmployee::class, EAdmin::class);
        $user = CUser::getLoggedUser();
        
        $name = $_GET['name'] ?? null;
        $date = $_GET['date'] ?? null;
        $sport = $_GET['sport'] ?? null;
        
        $filtered = FPersistentManager::getInstance()->retriveFilteredReservations($name, $date, $sport);
        
        $view = new VDashboard();
        $view->showFilteredReservations($filtered, $name, $date,$sport, $role);
    }

    public static function manageUsers() {
        CUser::isLogged();
        $role = self::assertRole(EAdmin::class);
        $user = CUser::getLoggedUser();
        
        
        $userList = FPersistentManager::getInstance()->retrieveAllUsers();
        //print_r ($userList);
        $view = new VDashboard();
        $view->showManageUsers($userList, $user, $role);

    }
    
    
}
