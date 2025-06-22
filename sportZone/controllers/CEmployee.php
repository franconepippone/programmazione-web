



public static function cancelReservation() {
    // 1. Check if user is logged in and is employee
    if (!CUser::isLogged() || !CUser::isEmployee()) {
        $errorView = new VError();
        $errorView->show("Devi essere un dipendente per effettuare questa operazione.");
        return;
    }

    // 2. Get POST parameter (reservation id)
    $reservationId = $_POST['id'] ?? null;

    // 3. Retrieve reservation from DB
    $reservation = null;
    if ($reservationId !== null && is_numeric($reservationId)) {
        $reservation = FPersistentManager::getInstance()->retriveObj(EReservation::class, intval($reservationId));
    }

    // 4. Check reservation exists
    if (!$reservation) {
        $errorView = new VError();
        $errorView->show("Prenotazione non trovata.");
        return;
    }

    // 5. If confirmed, delete and show confirmation
    if (isset($_POST['confirm'])) {
        FPersistentManager::getInstance()->deleteObj($reservation);
        $view = new VReservation();
        $view->showCancelConfirmation();
        return;
    }

    // 6. Otherwise, show cancellation form
    $view = new VReservation();
    $view->showCancelReservation($reservation);
}
