<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class CEnrollment
{
    public static function enrollmentConfirmation($course_id) {
        CUser::isLogged();
        $user= CUser::getLoggedUser();
        CUser::assertRole(EClient::class);
        //prendo l id dell utente dalla sessione
        
        
        $course=FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        
        self::isEnrolled($course,$user);
        $view = new VEnrollment();
        $view->showEnrollmentConfirmation($user,$course);
    }

    // Mostra il form di iscrizione a un corso
    public static function enrollForm($course_id)
    {
        CUser::isLogged();
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        $userID = USession::getSessionElement('user');
        $user = FPersistentManager::retriveUserOnId($userID);

        $view = new VEnrollment();
        $view->showEnrollForm($course, $user);
    }





    // Finalizza l'iscrizione a un corso
    public static function finalizeEnrollment($course_id)
    {
        CUser::isLogged();
        
        $user = CUser::getLoggedUser();

        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);

        
        self::isEnrolled($course,$user);//se iscritto non lo fa procedere

        // Verifica se già iscritto
        

        // Crea iscrizione
        $enrollment = new EEnrollment();
        $enrollment->setClient($user);
        $enrollment->setCourse($course);
      
        $enrollment->setEnrollmentDate(new DateTime(date('Y-m-d')));

        FPersistentManager::getInstance()->saveEnrollment($enrollment);
        $message='Iscrizione avvenuta con successo';
        $butt_name ="le mie iscrizioni ";
        $butt_action="window.location.href='/dashboard/myEnrollments'";
            $view = new VError;
            $view->showSuccess($message, $butt_name,$butt_action);
        $view = new VEnrollment();
        $view->showEnrollmentFinalization($enrollment);
    }

    // Mostra tutti i corsi a cui l'utente è iscritto
    public static function isEnrolled($course,$user)
    {
        $verifyFields = ['client' => $user->getId(), 'course'=> $course->getId()];
        if (FPersistentManager::getInstance()->retriveEnrollmentOnAttributes($verifyFields)) {
        
            (new VError())->show("Sei già iscritto a questo corso.");

            return;
        }
        
    }





















    
    
    // eliminazione iscrizione (non implementato nella dashboard ep)
    public static function deleteEnrollment($enrollment_id)
    {
        CUser::isLogged();

        CUser::assertRole(EEmployee::class);

        $user= CUser::getLoggedUser();
        
        $enrollments = FPersistentManager::retriveEnrollmentsOnCourseId($user->getId());
        
        if (sizeof($enrollments)==0){
            $view = new VError(); 
            $message='Nessuna iscrizione trovata';
            $butt_name ="Indietro ";
            $butt_action="window.location.href='/dashboard/showEnrollments'";
            $view->show($message, $butt_name,$butt_action);
        }
        else{
            FPersistentManager::getInstance()->removeEnrollment($enrollment_id);
            $message='Iscrizione trovata';
            $butt_name ="avanti ";
            $butt_action="window.location.href='/enrollment/EnrollmentDetails'";
            $view = new VError(); 
            $view->showSuccess($message, $butt_name,$butt_action);
        }
    }

    public static function EnrollmentDetails()
    {
        
        $role = self::assertRole(EClient::class);
        $user = CUser::getLoggedUser();
        $userId = $user->getId();
        $enrollments = FPersistentManager::getInstance()->retriveEnrollmentsOnUserId($userId);

        $view = new VDashboard();
        $view->showMyEnrollments($enrollments, $user, $role);
    }
    

    // Mostra tutti gli iscritti a un corso (per istruttore/admin)
    public static function showEnrollmentsOfCourse($course_id)
    {
        CUser::isLogged();
        $enrollments = FPersistentManager::getInstance()->retriveEnrollmentsOnCourseId($course_id);

        $view = new VEnrollment();
        $view->showEnrollmentsOfCourse($enrollments, $course_id);
    }

    

    
}