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

    public static function myReservatsions(){
        CUser::isLogged();
        $role = self::assertRole(EClient::class);
        
        $view = new VDashboard();
        $user = CUser::getLoggedUser();
        $view->showDashboarMyReservations($user, $role);
    
    }

     public static function myReservations() {
        
        CUser::isLogged();
        $role = self::assertRole(EClient::class);

        //$clientId = CUser::getCurrentUser()->getId();
        $clientId = $_SESSION['user'];
        $reservation = FPersistentManager::getInstance()->retriveActiveReservationByClientId($clientId);
        $active = $reservation !== null;

        $view = new VDashboard();

        $view->showMyReservationDetails($reservation, $active, CUser::getUserRole());

    }



    // ----------------- CLIENT & INSTRUCTOR ONLY -----------------------
    
    public static function _myCourses(){
        CUser::isLogged();
        $role = self::assertRole(EClient::class, EInstructor::class);
        
        $view = new VDashboard();
        $user = CUser::getLoggedUser();
        $view->showDashboardMyCourses($user, $role);
        
    }

    public static function myCourses() {
        CUser::isLogged();
        $role = self::assertRole(EClient::class, EInstructor::class);
        $user = CUser::getCurrentUser();

        if(Cuser::isInstructor()){
            $mycourses= FPersistentManager::getInstance()->retriveCoursesOnInstructorId($user->getId());
            
        }
        else if(Cuser::isClient()){
            $myenrollmens= FPersistentManager::getInstance()->retriveEnrollmentsOnUserId($user->getId());
            foreach ($myenrollmens as $enrollment) {
                $mycourses[] = $enrollment->getCourse();
            }
            
            
        }
        else{
            (new VError())->show("Devi essere un istruttore o un cliente per accedere a questa pagina.");
            return;
        }

        $view = new VDashboard();
        $view->showDashboardMyCourses($mycourses, $role);
    }




    // --------------- EMPLOYEE ONLY -----------------

    public static function manageCourses(){
        CUser::isLogged();
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageCourses($user, $role);
    }

    public static function manageFields(){
        CUser::isLogged();
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageFields($user, $role);
    }

    public static function manageUsers(){
        CUser::isLogged();
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
        ;
        $view->showManageReservations($reservations, $role);
    }
}
