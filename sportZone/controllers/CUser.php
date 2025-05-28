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
            self::isBanned();
        }
        if(!$logged){
            header('Location: /Agora/User/login');
            exit;
        }
        return true;
    }

    public static function register(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            header('Location: /Agora/User/home');
        }

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
            header('Location: /Agora/User/home');
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

        // checks if email and username are already present in the database
        if(!FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) ||
        !FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'))) 
        {
            echo "User already present";
            return;
        }

        $new_user = new EClient(
            UHTTPMethods::post('username'), 
            '',
            UHTTPMethods::post('birthdate'),
            UserSex::MALE, 
            UHTTPMethods::post('email'),
            UHTTPMethods::post('username'),
            UHTTPMethods::post('password')
        );
        // register was succesfull
        $check = FPersistentManager::getInstance()->uploadObj($new_user);
        if($check){
            echo "success";
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

        /*
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if($username){
            $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user->getPassword())){
                if($user->isBanned()){
                    $view->loginBan();

                }elseif(USession::getSessionStatus() == PHP_SESSION_NONE){
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    header('Location: /Agora/User/home');
                }
            }else{
                $view->loginError();
            }
        }else{
            $view->loginError();
        }*/

        $view->showHomePage();
    }

    /**
     * this method can logout the User, unsetting all the session element and destroing the session. Return the user to the Login Page
     * @return void
     */
    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Agora/User/login');
    }

    /**
     * load all the Posts in homepage (Posts of the Users that the logged User are following). Also are loaded Information about vip User and
     * about profile Images of all the involved User
     */
    public static function home(){
        if(CUser::isLogged()){
            $view = new VUser();

            $userId = USession::getInstance()->getSessionElement('user');
            $userAndPropic = FPersistentManager::getInstance()->loadUsersAndImage($userId);

            //load all the posts of the users who you follow(post have user attribute) and the profile pic of the author of teh post
            $postInHome = FPersistentManager::getInstance()->loadHomePage($userId);
            
            //load the VIP Users, their profile Images and the foillower number
            $arrayVipUserPropicFollowNumb = FPersistentManager::getInstance()->loadVip();

            //var_dump($userAndPropic[0][1]->getImageData());

            //var_dump($userAndPropic[0][0]->getUsername());
            $view->home($userAndPropic, $postInHome,$arrayVipUserPropicFollowNumb);
        }  
    }

}