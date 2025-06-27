<?php

use App\Enum\UserSex;
use Doctrine\DBAL\Exception as DBALException;

require_once __DIR__ . "/../../vendor/autoload.php";

class CClient{

    private static function assertRole(): string {
        $role = CUser::getUserRole();
        if ($role != EClient::class) {
            $verr = new VError();
            $verr->show("You have no access to this page.");
            exit;
        }
        return $role;
    }

    public static function profile(){
        CUser::isLogged();
        $role = CClient::assertRole();

        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showDashboardProfile($user, $role);
    
    }


    public static function myCourses(){
        CUser::isLogged();
        $role = CClient::assertRole();
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showDashboardMyCourses($user, $role);
    
    }


    public static function myReservations(){
        CUser::isLogged();
        $role = CClient::assertRole();
        
        $view = new VDashboard();
        
        $user = CUser::getLoggedUser();
        $view->showDashboarMyReservations($user, $role);
    
    }

    public static function settings(){
        CUser::isLogged();
        $role = CClient::assertRole();
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showDashboardSettings($user, $role);
    
    }

}
