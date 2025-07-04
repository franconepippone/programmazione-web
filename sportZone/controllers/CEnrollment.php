<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class CEnrollment
{
    public static function enrollmentConfirmation($course_id) {
        CUser::isLogged();
        CUser::assertRole(EClient::class);
        $user= CUser::getLoggedUser();
        //prendo l id dell utente dalla sessione
        
        $course=FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        self::isEnrolled($course,$user);

        $maxParticipants = $course->getMaxParticipantsCount();
        $iscrizioni = FPersistentManager::getInstance()->retriveEnrollmentsOnCourseId($course_id);
        if(sizeof($iscrizioni)+1 > $maxParticipants) {
            (new VError())->show("Il corso è al completo. Non puoi iscriverti.");
            exit;
        }

        $view = new VEnrollment();
        $view->showEnrollmentConfirmation($user,$course);
    }

  
    public static function enrollForm($course_id)
    {
        CUser::isLogged();
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        $userID = USession::getSessionElement('user');
        $user = FPersistentManager::retriveUserOnId($userID);

        $view = new VEnrollment();
        $view->showEnrollForm($course, $user);
    }



    public static function finalizeEnrollment_pay($course_id)
    {
        CUser::isLogged();
        CUser::assertRole(EClient::class);
        $user = CUser::getLoggedUser();

        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);

        self::isEnrolled($course,$user);

        CPayment::startPayment($course->getEnrollmentCost(), '/enrollment/finalizeEnrollment/' . $course_id);
        exit; // should never reach here, payment should redirect
    }

    // Finalizza l'iscrizione a un corso
    public static function finalizeEnrollment($course_id)
    {
        CUser::isLogged();
        CUser::assertRole(EClient::class);

        $outcome = CPayment::getPaymentOutcome();
        if (!isset($outcome) || !isset($outcome['type'])) {
            (new VError())->show("Errore con il pagamento.");
            exit;
        }

        if ($outcome['type'] === CPayment::METHOD_ONSITE) {
            (new VError())->show(
                "Non è possibile iscriversi con questo metodo di pagamento. È consentito solo il pagamento online oppure presentarsi in struttura. Ci scusiamo per il disagio.",
            "Torna indietro", 
        'window.location.href="/course/courseDetails/' . $course_id . '"');
            exit;
        }

        $user = CUser::getLoggedUser();

        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);

        
        self::isEnrolled($course,$user);

    
        $enrollment = new EEnrollment();
        $enrollment->setClient($user);
        $enrollment->setCourse($course);
      
        $enrollment->setEnrollmentDate(new DateTime(date('Y-m-d')));

        FPersistentManager::getInstance()->saveEnrollment($enrollment);
        $message='Iscrizione avvenuta con successo';
        $butt_name ="le mie iscrizioni ";
        $butt_action="window.location.href='/dashboard/myEnrollments'";
        $view = new VError();
        $view->showSuccess($message, $butt_name,$butt_action);
        exit;
    }

    // Mostra tutti i corsi a cui l'utente è iscritto
    public static function isEnrolled($course,$user)
    {
        $verifyFields = ['client' => $user->getId(), 'course'=> $course->getId()];
        if (FPersistentManager::getInstance()->retriveEnrollmentOnAttributes($verifyFields)) {
        
            (new VError())->show("Sei già iscritto a questo corso.");
            exit;
        }
        
    }



    public static function deleteEnrollment($enrollment_id)
    {
        CUser::isLogged();
        $userID = USession::getSessionElement('user');
        $enrollment = FPersistentManager::getInstance()->retriveEnrollmentOnId($enrollment_id);

        if (!$enrollment || $enrollment->getUser()->getId() != $userID) {
            (new VError())->show("Iscrizione non trovata o non autorizzato.");
            return;
        }

        FPersistentManager::getInstance()->removeEnrollment($enrollment);

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