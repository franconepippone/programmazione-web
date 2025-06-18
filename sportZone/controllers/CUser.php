<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CUser{

    /**
     * check if the user is logged (using session)
     * @return boolean
     */
    public static function isLogged()
    {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        if(!$logged){
            header('Location: /User/login');
            exit;
        }
        return true;
    }

    public static function register(){
        $view = new VUser();
        $view->showRegistrationForm();
    }

    public static function login(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            header('Location: /user/home');
        }

        $view = new VUser();
        $view->showLoginForm();
    }

    /**
     * verify if the choosen username and email already exist, create the User Obj and set a default profile image 
     * @return void
     */
    public static function attemptRegister()
    {

        $view = new VUser();
        var_dump(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')));
        var_dump(FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username')));

        // checks if email and username are already present in the database
        if(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) ||
        FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'))) 
        {
            echo "User already present";
            return;
        }

        $new_user = new EClient(
            UHTTPMethods::post('name'), 
            UHTTPMethods::post('surname'),
            null,
            UserSex::MALE, 
            UHTTPMethods::post('email'),
            UHTTPMethods::post('username'),
            UHTTPMethods::post('password')
        );
        // register was succesfull
        $check = FPersistentManager::getInstance()->uploadObj($new_user);
        if($check){
            echo "success";
            header("Location: /user/login");
            //$view->showLoginForm();
        }
    }

    /**
     * check if exist the Username inserted, and for this username check the password. If is everything correct the session is created and
     * the User is redirected in the homepage
     */
    public static function checkLogin(){
        $view = new VUser();
        var_dump($_SERVER['REQUEST_METHOD']);  // Should be "POST"
        var_dump($_POST);
        echo "username: ". UHTTPMethods::post('username') . "<br>";
        echo "password: " . UHTTPMethods::post('password') . "<br>";

        
        $username_exists = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if($username_exists){
            $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user->getPasswordHashed())){
                if(USession::getSessionStatus() == PHP_SESSION_NONE){
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    header('Location: /user/home');
                }
            }else{
                $view->loginError();
            }
        }else{
            $view->loginError();
        }
    }

    /**
     * this method can logout the User, unsetting all the session element and destroing the session. Return the user to the Login Page
     * @return void
     */
    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /user/login');
    }

    public static function home(){
        if(CUser::isLogged()){
            $view = new VUser();

            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);-
            $view->showHomePage($user->getFullName());
        }  
    }

}