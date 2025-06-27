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

    public static function myReservations(){
        
        $role = self::assertRole(EClient::class);
        
        $view = new VDashboard();
        $user = CUser::getLoggedUser();
        $view->showDashboarMyReservations($user, $role);
    
    }

    // ----------------- CLIENT & INSTRUCTOR ONLY -----------------------

    public static function myCourses(){
        
        $user = CUser::getLoggedUser();
        $role = self::assertRole(EInstructor::class);
        
        $mycourses= FPersistentManager::getInstance()->retriveCoursesOnInstructorId($user->getId());

        // Mostra la vista di gestione corsi istruttore
        $view = new VDashboard();
        $view->showMyCourses($mycourses, $user, $role,);
    }




    // --------------- EMPLOYEE ONLY -----------------

    public static function manageCourses(){
       
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageCourses($user, $role);
    }

    public static function manageFields(){
        
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageFields($user, $role);
    }

    public static function manageReservations(){
        
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageReservations($user, $role);
    }

    public static function manageUsers(){
     
        $role = self::assertRole(EEmployee::class);
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageUsers($user, $role);
    }

}
