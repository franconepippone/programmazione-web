<?php

use App\Enum\UserSex;
use Doctrine\DBAL\Exception as DBALException;

require_once __DIR__ . "/../../vendor/autoload.php";

class CUser {

    // Array of rules for validating user registration inputs
    // The keys are the input names, and the values are the validation methods (inside the UValidate class)
    private static $rulesRegister = [
        "name" => 'validateName',
        "surname" => 'validateName',
        "email" => 'validateEmail',
        "username" => 'validateUsername',
        "password" => 'validatePassword',
        "birthday" => 'validateBirthDate'
    ];

    private static $rulesModifyClient = [
        "name" => 'validateName',
        "surname" => 'validateName',
        "email" => 'validateEmail',
        "username" => 'validateUsername',
        "password" => 'validatePassword',
        "birthday" => 'validateBirthDate',
        "gender" => 'validateGender'
    ];

    public static function assertRole(...$allowedRoles): string {
        $role = CUser::getUserRole();
        if (!in_array($role, $allowedRoles, true)) {
            $verr = new VError();
            $verr->show("Non hai accesso a questa pagina. Devi essere un cliente");
            exit;
        }
        return $role;
    }


    public static function isLoggedBool(): bool 
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

        return $logged;
    }

    /**
     * Checks if the user is logged in.
     * If not, redirects to the login page with a redirect argument set to the current page.
     * 
     * @return bool True if the user is logged in, otherwise redirects to login.
     */
    #[PathUrl(PathUrl::HIDDEN)]
    public static function isLogged()
    {
        $logged =  self::IsLoggedBool();

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
 
    // Registers a new user by displaying the registration form.
    public static function register(){
        $view = new VUser();
        $view->showRegistrationForm();
    }

    // Displays the login form for the user.
    public static function login(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }

        // If the login is trying to redirect to a page other than home
        $redirectUrl = "/user/home";
        if (UHTTPMethods::getIsSet("redirect")) {
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
        session_regenerate_id(true);
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

        // validates form inputs
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
        
        // creates new client
        $newClient = (new EClient())
        ->setName($formInputs['name'])
        ->setSurname($formInputs['surname'])
        ->setSex(UserSex::MALE)
        ->setEmail($formInputs['email'])
        ->setUsername($formInputs['username'])
        ->setPassword($formInputs['password'])
        ->setBirthDate(
            new DateTime($formInputs['birthday']->format('Y-m-d'))
        );

        
        // register was succesfull
        $check = FPersistentManager::getInstance()->uploadObj($newClient);
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

        $redirectUrl = "/user/home";
        if (UHTTPMethods::getIsSet("redirect")) {
            header('Location: ' . UHTTPMethods::get("redirect"));
        } else {
            header('Location: /user/home');
        }
    }

    public static function home() {
        $logged = CUser::isLoggedBool();

        $view = new VUser();
        $view->showHome($logged);
    }

    public static function modifyUserRequest() {
        CUser::isLogged();
        $user = CUser::getLoggedUser();

        // TODO this should work also for instructors and employees
        try {
            $inputs = UValidate::validateInputArray($_POST, self::$rulesModifyClient, false);
        } catch (ValidationException $e) {
            // if validation fails, show the error message
            (new VError())->show($e->getMessage());
            exit;
        }

        if (isset($inputs['name'])) $user->setName($inputs['name']);
        if (isset($inputs['surname'])) $user->setSurname($inputs['surname']);
        if (isset($inputs['email'])) $user->setEmail($inputs['email']);
        if (isset($inputs['password'])) $user->setPassword($inputs['password']);
        if (isset($inputs['birthday'])) $user->setBirthDate($inputs['birthday']);
        if (isset($inputs["gender"])) $user->setSex(UserSex::from($inputs["gender"]));
        // TODO Non aggiorna il gender

        if (UHTTPMethods::files("profilePicture", "name") != null) {
            $imgName = UImage::storeImageGetFilename(UHTTPMethods::files("profilePicture"));
            $user->setProfilePicture($imgName);
        }

        if (isset($inputs["profilePicture"])) $user->setSex($inputs["profilePicture"]);
        
        $view = new VError();
        
        if (isset($inputs['username'])) {
            echo "SISIS";
            if (FPersistentManager::getInstance()->verifyUserUsername($inputs["username"])) {
                if ($user->getUsername() !== $inputs['username']) {
                    $view->show("Username già preso da qualcun'altro.");
                    exit;
                }
            }
            $user->setUsername($inputs['username']);
        }
        

        $ok = FPersistentManager::getInstance()->uploadObj($user);
        if (!$ok) {
            $view->show("Errore di caricamento sul database");
            exit;
        }
 
        $view->showSuccess("Dati modificati con successo.");
        exit;
    }
    

    /**
     * Retrieves the currently logged-in user from the session.
     *
     * If the user is logged in, retrieves the user ID from the session and returns the corresponding EUser object.
     * If the user is not logged in, returns null.
     *
     * @return EUser|null The logged-in user object if available, or null if not logged in.
     */
    #[PathUrl(PathUrl::HIDDEN)]
    public static function getLoggedUser(): ?EUser
    {
        if (self::isLogged()) {
            $userId = USession::getSessionElement('user');
            return FPersistentManager::getInstance()->retriveUserOnId($userId);
        }
        return null;
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
    #[PathUrl(PathUrl::HIDDEN)]
    public static function getUserRole(): ?string
    {
        if (self::isLoggedBool()) {
            if (USession::isSetSessionElement('role')) {
                return USession::getSessionElement('role');
            } 
        }

        return null;
    }

    #[PathUrl(PathUrl::HIDDEN)]
    public static function isEmployee()
    {
        return self::getUserRole() === EEmployee::class;
    }

    #[PathUrl(PathUrl::HIDDEN)]
    public static function isInstructor()
    {
        return self::getUserRole() === EInstructor::class;
    }

    #[PathUrl(PathUrl::HIDDEN)]
    public static function isClient()
    {
        return self::getUserRole() === EClient::class;
    }

}
