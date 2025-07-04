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

    private static $rulesModifyUser = [
        "name" => 'validateName',
        "surname" => 'validateName',
        "email" => 'validateEmail',
        "username" => 'validateUsername',
        "password" => 'validatePassword',
        "birthday" => 'validateBirthDate',
        "gender" => 'validateGender',
        "cvv" => 'skipValidation'
    ];

    #[PathUrl(PathUrl::HIDDEN)]
    public static function assertRole(...$allowedRoles): string {
        $role = CUser::getUserRole();
        if (!in_array($role, $allowedRoles, true)) {
            $verr = new VError();
            $verr->show("Non hai accesso a questa pagina.");
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
        if (CUser::isLoggedBool()) {
            header("Location: /user/home");
            exit;
        }
        $view = new VUser();
        $view->showRegistrationForm();
    }

    // Displays the login form for the user.
    public static function login(){
        if(UCookie::isSet(SESSION_NAME)){
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
            (new VError())->show(message: "L'username inserito è inesistente");
            exit;
        }
        
        // retrieves user
        $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));

        // if password is correct
        if(!password_verify(UHTTPMethods::post('password'), $user->getPasswordHashed())) {
            (new VError())->show("Password incorretta");
            exit;
        }

        // if session is already started, stop execution (this method should only be called at login, not during session)
        if(USession::getSessionStatus() != PHP_SESSION_NONE) {
            (new VError())->show("Session already started, please logout first.");
            exit;
        }

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
        setcookie(SESSION_NAME, '', time() - 3600);

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

    public static function modifyUserForm($id) {
        CUser::isLogged();
        CUser::assertRole(EAdmin::class);

        $user = FPersistentManager::getInstance()->retriveUserById($id);
        if ($user == null) {
            (new VError())->show('Invalid user ID');
            exit;
        }

        $view = new VUser();
        $view->showModifyForm($user, $user::class);

    }


    /**
     * Validates input data and attempts to set a property on a user object using a specified setter method.
     *
     * This method performs three main tasks:
     * 1. Validates the entire input array using predefined validation rules (`self::$rulesModifyUser`).
     * 2. If the specified key exists and the setter method exists on the `EUser` object, it sets the value.
     * 3. Optionally transforms the value (e.g., enum conversion) before setting it.
     *
     * If validation fails, an error view is displayed and script execution is halted.
     *
     * @param array         $inputs     The raw input array (e.g., $_POST) to validate and extract the value from.
     * @param string        $key        The specific key to look for in the validated input array.
     * @param EUser         $user       The user object on which to invoke the setter method.
     * @param string        $setMethod  The name of the setter method to invoke (e.g., 'setEmail').
     * @param callable|null $transform  Optional. A callback to transform the input value before setting it.
     *                                   Example: fn($val) => UserSex::from($val)
     *
     * @return bool Returns true if the value was successfully set; false otherwise.
     *
     * @throws ValidationException If the input array fails validation (though caught internally).
     *
     * @example
     * self::attemptModifyFromInputArray($_POST, 'email', $user, 'setEmail');
     * self::attemptModifyFromInputArray($_POST, 'gender', $user, 'setSex', fn($val) => UserSex::from($val));
     */
    private static function attemptModifyFromInputArray(array $inputs, string $key, EUser $user, string $setMethod, callable $transform = null): bool {      
        if (isset($inputs[$key]) && method_exists($user, $setMethod)) {
            $value = $transform ? $transform($inputs[$key]) : $inputs[$key];
            $user->$setMethod($value);
            return true;
        }
        return false;
    }

    // tenta la modifica di un qualsiasi utente
    private static function modifyUserFromImputs(array $inputs, EUser $user) {
        
        try {
            $inputs = UValidate::validateInputArray($inputs, self::$rulesModifyUser, false);
        } catch (ValidationException $e) {
            // if validation fails, show the error message
            (new VError())->show($e->getMessage());
            exit;
        }

        self::attemptModifyFromInputArray($inputs, 'name', $user, 'setName');
        self::attemptModifyFromInputArray($inputs, 'surname', $user, 'setSurname');
        self::attemptModifyFromInputArray($inputs, 'password', $user, 'setPassword');
        self::attemptModifyFromInputArray($inputs, 'birthday', $user, 'setBirthDate');
        self::attemptModifyFromInputArray($inputs, 'cvv', $user, 'setCv');
        // Special case: convert string to enum
        self::attemptModifyFromInputArray($inputs, 'gender', $user, 'setSex', fn($val) => UserSex::from($val));
        
        // caso per immagine di profilo
        if (UHTTPMethods::files("profilePicture", "name") != null) {
            $imgName = UImage::storeImageGetFilename(UHTTPMethods::files("profilePicture"));
            $user->setProfilePicture($imgName);
        }
        
        // check per unicità di email
        if (isset($inputs['email'])) {
            if (FPersistentManager::getInstance()->verifyUserEmail($inputs["email"])) {
                if ($user->getEmail() !== $inputs['email']) {
                    $view = new VError();
                    $view->show("Email già presa da qualcun'altro.");
                    exit;
                }
            }
            $user->setEmail($inputs['email']);
        }

        // check per unicità di username
        if (isset($inputs['username'])) {
            if (FPersistentManager::getInstance()->verifyUserUsername($inputs["username"])) {
                if ($user->getUsername() !== $inputs['username']) {
                    $view = new VError();
                    $view->show("Username già preso da qualcun'altro.");
                    exit;
                }
            }
            $user->setUsername($inputs['username']);
        }

        $view = new VError();

        $ok = FPersistentManager::getInstance()->uploadObj($user);
        if (!$ok) {
            $view->show("Errore di caricamento sul database");
            exit;
        }
 
        $view->showSuccess("Dati modificati con successo.");
        exit;
    }

    public static function finalizeModifyAnyUser($id) {
        CUser::isLogged();
        CUser::assertRole(EAdmin::class);
        
        $user = FPersistentManager::getInstance()->retriveUserById($id);
        if ($user == null) {
            (new VError())->show('Invalid user ID');
            exit;
        }

        // modifies selected user
        self::modifyUserFromImputs($_POST, $user);
        exit;
    }

    public static function modifyUserRequest() {
        CUser::isLogged();
        $user = CUser::getLoggedUser();

        self::modifyUserFromImputs($_POST, $user);
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

    #[PathUrl(PathUrl::HIDDEN)]
    public static function isAdmin()
    {
        return self::getUserRole() === EAdmin::class;
    }

    
    private static $rulesCreate = [
        'name'            => 'validateName',
        'surname'      => 'validateName',
        'username'       => 'validateUsername',
        'password'         => 'validatePassword',
        'email'             => 'validateemail',
        'date'              => 'validateDate'
    ];

    public static function userCreationForm() {
        CUser::isLogged();
        CUser::assertRole(EAdmin::class);

        $view = new VUser();
        $view->showUserCreationForm();
    }


    public static function finalizeUserCreation() {
        CUser::isLogged();
        CUser::assertRole(EAdmin::class);

        $post = $_POST;
        $pm = FPersistentManager::getInstance();

        try {
        
            $validated = UValidate::validateInputArray($post, self::$rulesCreate, true);

        
            $validRoles = ['client', 'employee', 'instructor'];
            if (empty($post['role']) || !in_array($post['role'], $validRoles)) {
                throw new ValidationException("Ruolo selezionato non valido.");
            }
            $role = $post['role'];

            switch ($role) {
                case 'client':
                    $entity = new EClient();
                    break;

                case 'employee':
                    $entity = new EEmployee();
                    break;

                case 'instructor':
                    $entity = new EInstructor();
                    break;
            }

            $entity->setName($validated['name']);
            $entity->setSurname($validated['surname']);
            $entity->setUsername($validated['username']);
            $entity->setPassword($validated['password']);
            $entity->setEmail($validated['email']);
            $entity->setBirthDate($validated['date']);
            $entity->setSex(UserSex::MALE);

            $pm->uploadObj($entity);

               
          
                        


            (new VError())->showSuccess(
                "Utente creato con successo!",
                "Torna alla homepage",
                "window.location.href='/user/home'"
            );

        } catch (ValidationException $e) {
            $msg = $e->getMessage();
            if (!empty($e->details['params'])) {
                $msg .= "<br>Mancano: " . implode(', ', $e->details['params']);
            }
            (new VError())->show($msg, "Torna indietro", "history.back()");
        } 


    }


    public static function deleteUser(){
        CUser::isLogged();
        CUser::assertRole(EAdmin::class);

        $idUser = $_POST['id'] ?? null;
        if ($idUser==null) {
            $view=new VError();
            $view->show('Id mancante.');
            exit;
        }
        $user=FPersistentManager::retriveUserById($idUser);
        if ($user==null) {
            $view=new VError();
            $view->show('Utente non trovato.');
            exit;
        }

        // can't delete admin
        if ($user::class === EAdmin::class) {
            (new VError())->show('Non puoi eliminare un admin.');
            exit;
        }

        if ($user::class === EInstructor::class) {
            // if the user is an instructor, remove all his courses
            $courses = $user->getCourses();
            foreach ($courses as $course) {
                FPersistentManager::removeCourse($course);
            }
        }
        // same thing for reservations
        if ($user::class === EClient::class) {
            $reservations = $user->getReservations();
            foreach ($reservations as $reservation) {
                FPersistentManager::removeReservation($reservation);
            }
        }

        FPersistentManager::removeUser($user);
        (new VError())->showSuccess('Utente eliminato con successo','Continua',"window.location.href='/dashboard/manageUsers'");
        
    }

}
