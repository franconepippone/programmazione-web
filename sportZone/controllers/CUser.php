<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CUser{

    private static $rulesRegister = [
        "name" => 'validateName',
        "surname" => 'validateName',
        "email" => 'validateEmail',
        "username" => 'validateUsername',
        "password" => 'validatePassword',
        "birthday" => 'validateDate'
    ];

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
        // if username exists
        $username_exists = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if(!$username_exists) {
            (new VError())->show("sorry, the username you entered does not exist.");
            exit;
        }
        
        // retrieves user
        $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));

        // if password is correct
        if(!password_verify(UHTTPMethods::post('password'), $user->getPasswordHashed())) {
            (new VError())->show("sorry, the password you entered is incorrect.");
            exit;
        }

        // if session is already started, stop execution (this method should only be called at login, not during session)
        if(USession::getSessionStatus() != PHP_SESSION_NONE) {
            (new VError())->show("Session already started, please logout first.");
            exit;
        }

        // fills session variables with user data
        USession::getInstance();
        USession::setSessionElement( 'user', $user->getId());
        USession::setSessionElement( 'role', $user::class);
        
        // if a redirect url is sent (should always be sent), redirect to that page
        if (UHTTPMethods::postIsSet('redirectUrl')) {
            header('Location: ' . UHTTPMethods::post('redirectUrl'));
        } else {
            header('Location: /user/home');
        }

    }

    /**
     * verify if the choosen username and email already exist, create the User Obj and set a default profile image 
     * @return void
     */
    public static function finalizeRegister()
    {
        $verr = new VError();

        try {
            $formInputs = UValidate::validateInputArray($_POST, self::$rulesRegister, true);
        } catch (ValidationException $e) {
            // if validation fails, show the error message
            $verr->show($e->getMessage());
            exit;
        }
        
        // checks if email and username are already present in the database
        if(FPersistentManager::getInstance()->verifyUserEmail($formInputs['email']) ||
        FPersistentManager::getInstance()->verifyUserUsername($formInputs['username'])) 
        {
            $verr->show("The email or username you entered already exists. Please choose a different one.");
            exit;
        }
        
        // validate the form inputs
        $new_user = (new EClient())
        ->setName($formInputs['name'])
        ->setSurname($formInputs['surname'])
        ->setSex(UserSex::MALE)
        ->setEmail($formInputs['email'])
        ->setUsername($formInputs['username'])
        ->setPassword($formInputs['password'])
        ->setBirthDate(
            new DateTime($formInputs['birthday'])
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
            $view->showHomePage($user->getFullName() . " " . self::getUserRole());
        }  
    }

    /**
     * Retrieves the current user's role from the session.
     *
     * If the user is logged in and the 'role' session element is set, returns the user's role as a string.
     * If the user is logged in but the 'role' session element is missing, logs out the user for safety.
     * If the user is not logged in, returns null.
     *
     * @return string|null The user's role if available, or null if not logged in.
     */
    public static function getUserRole(): ?string
    {
        if (self::isLogged()) {
            if (USession::isSetSessionElement('role')) {
                return USession::getSessionElement('role');
            } else {
                // if role is not set, then something is creally wrong with how the user managed to create a session,
                // therefore we logout just in case
                self::logout();
            }
        };
    }

    public static function isEmployee()
    {
        return self::getUserRole() === EEmployee::class;
    }

    public static function isInstructor()
    {
        return self::getUserRole() === EInstructor::class;
    }

    public static function isClient()
    {
        return self::getUserRole() === EClient::class;
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
