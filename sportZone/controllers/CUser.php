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

        // if not logged, redirects the user to the login page with a redirect argument set the caller's path
        // This way, when user finishes login, he is redirected back to the site he was visiting
        if(!$logged){
            $query = http_build_query([
                'redirect' => $_SERVER['REQUEST_URI']
            ]);

            header('Location: /user/login?' . $query);
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

        // If the login is trying to redirect to a page other than home
        $redirectUrl = "/user/home";
        if (isset($_GET["redirect"])) {
            $redirectUrl = UHTTPMethods::get("redirect");
        }

        if(USession::isSetSessionElement('user')){
            header('Location: ' . $redirectUrl);
        }

        $view = new VUser();
        $view->showLoginForm($redirectUrl);
    }

    /**
     * check if exist the Username inserted, and for this username check the password. If is everything correct the session is created and
     * the User is redirected in the homepage or requested resource
     */
    public static function checkLogin(){
        $view = new VUser();
        var_dump($_SERVER['REQUEST_METHOD']);  // Should be "POST"
        var_dump($_POST);
        echo "username: ". UHTTPMethods::post('username') . "<br>";
        echo "password: " . UHTTPMethods::post('password') . "<br>";

        $username_exists = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if(!$username_exists) {
            $view->loginError();
            exit;
        }
        
        $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
        if(password_verify(UHTTPMethods::post('password'), $user->getPasswordHashed())){
            if(USession::getSessionStatus() == PHP_SESSION_NONE){
                USession::getInstance();
                USession::setSessionElement( 'user', $user->getId());
                //USession::setSessionElement( 'user', $user->getId());
                
                // if a redirect url is sent (should always be sent), redirect to that page
                if (UHTTPMethods::postIsSet('redirectUrl')) {
                    header('Location: ' . UHTTPMethods::post('redirectUrl'));
                } else {
                    header('Location: /user/home');
                }
            }
        }else{
            $view->loginError();
        }
        
    }

    /**
     * verify if the choosen username and email already exist, create the User Obj and set a default profile image 
     * @return void
     */
    public static function finalizeRegister()
    {
        $view = new VUser();

        // checks if email and username are already present in the database
        if(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) ||
        FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'))) 
        {
            // TODO display error message
            echo "User already present";
            return;
        }

        $new_user = (new EClient())
        ->setName(UHTTPMethods::post('name'))
        ->setSurname(UHTTPMethods::post('surname'))
        ->setSex(UserSex::MALE)
        ->setEmail(UHTTPMethods::post('email'))
        ->setUsername(UHTTPMethods::post('username'))
        ->setPassword(UHTTPMethods::post('password'))
        ->setBirthDate(
            new DateTime(UHTTPMethods::post('birthday'))
        );

        // register was succesfull
        $check = FPersistentManager::getInstance()->uploadObj($new_user);
        if($check){
            echo "Registration successfull, redirecting to /user/login... (if you see this something went wrong)";
            header("Location: /user/login");
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

      /**
 * This method checks if the current user is logged in and has the role of "employee".
 * It initializes the session if needed, verifies the user session element,
 * and confirms the user's role. If the user is not logged in or does not have
 * the "employee" role, it redirects to the appropriate page (login or access denied).
 * 
 * @return bool Returns true if the user is logged in as employee, otherwise redirects and exits.
 */

    public static function isEmployee()
{
    if (UCookie::isSet('PHPSESSID')) {
        if (session_status() == PHP_SESSION_NONE) {
            USession::getInstance();
        }
    }

    if (!USession::isSetSessionElement('user')) {
        header('Location: /User/login');
        exit;
    }

    $user = USession::getSessionElement('user');

    if (!isset($user['role']) || $user['role'] !== 'employee') {
        // Qui mostri l’errore subito senza redirect
        $errorView = new VError();
        $errorView->show("Accesso negato. Non hai i permessi per accedere a questa pagina.");
        exit;
    }

    return true;
}

    public static function usertoArray($user) {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'sex'=> 'male',
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'birthDate' => $user->getBirthDate()->format('Y-m-d')
        ];
    }
}
