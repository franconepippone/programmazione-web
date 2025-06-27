<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class CEnrollment
{
    public static function enrollmentConfirmation($course_id) {
        CUser::isLogged();
        //prendo l id dell utente dalla sessione
        $userID = USession::getSessionElement('user');
        $user= FPersistentManager::retriveUserOnId($userID);
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
        
        $userID = USession::getSessionElement('user');
        $user = FPersistentManager::retriveUserOnId($userID);
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);

        
        self::isEnrolled($course,$user);

        // Verifica se già iscritto
        

        // Crea iscrizione
        $enrollment = new EEnrollment();
        $enrollment->setClient($user);
        $enrollment->setCourse($course);
      
        $enrollment->setEnrollmentDate(new DateTime(date('Y-m-d')));

        FPersistentManager::getInstance()->saveEnrollment($enrollment);

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






















    
    // Permette di annullare l'iscrizione a un corso
    public static function deleteEnrollment($enrollment_id)
    {
        CUser::isLogged();
        $userID = USession::getSessionElement('user');
        $enrollment = FPersistentManager::getInstance()->retriveEnrollmentOnId($enrollment_id);

        if (!$enrollment || $enrollment->getUser()->getId() != $userID) {
            (new VError())->show("Iscrizione non trovata o non autorizzato.");
            return;
        }

        FPersistentManager::getInstance()->deleteEnrollment($enrollment_id);

        $view = new VEnrollment();
        $view->showDeleteConfirmation();
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