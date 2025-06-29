<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";
class CAdmin {



    private static $rulesCreate = [
        'name'            => 'validateName',
        'surname'      => 'validateName',
        'username'       => 'validateUsername',
        'password'         => 'validatePassword',
    ];

    public static function userCreationForm() {
        CUser::isAdmin(); 

        $view = new VAdmin();
        $view->showUserCreationForm();
    }


    public static function finalizeUserCreation() {
        CUser::isAdmin();

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
            $entity->setEmail('default@default');
            $entity->setBirthDate(new \DateTime('2000-01-01'));
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
}