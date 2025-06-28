<?php
class UUtility {

    
    public static function retriveAvaiableHoursForFieldAndDate(int $fieldId, string $date): array {

        // Recupera tutte le reservation per quel campo
        $allReservations = FReservation::getReservationByFieldId($fieldId);

        // Filtra solo quelle con la data richiesta
        $filteredReservations = [];
        $dateObj = new DateTime($date);
        $dateString = $dateObj->format('Y-m-d');
        foreach ($allReservations as $reservation) {
            if ($reservation->getDate()->format('Y-m-d') === $dateString) {
                $filteredReservations[] = $reservation;
            }
        }

        // Estrai gli orari occupati (formato H:i:s)
        $occupiedHours = [];
        foreach ($filteredReservations as $reservation) {
            $occupiedHours[] = $reservation->getTime()->format('H:i:s');
        }

        // Costruisci tutti gli orari possibili tra le 8 e le 21 (formato H:i:s)
        $allHours = [];
        for ($hour = 8; $hour < 21; $hour++) {
            $allHours[] = sprintf('%02d:00:00', $hour); // "08:00:00"
        }

        // Rimuovi gli orari occupati
        $availableHours = array_diff($allHours, $occupiedHours);

        // Restituisci gli orari liberi ordinati
        return array_values($availableHours);
    }

    /**
     * Retrieve a reservation by client ID and check if it is active (today or future)
     */
    
  
    public static function retriveActiveReservationByUserId(int $userId) {
        $reservations = FReservation::getReservationsByUserId($userId);
        if (!is_array($reservations)) {
            $reservations = $reservations ? [$reservations] : [];
        }
        $today = new DateTime('today');
        foreach ($reservations as $res) {
            if ($res->getDate() instanceof DateTimeInterface && $res->getDate() >= $today) {
                return $res;
            }
        }
        return null;
    }


    
    





    public static function getDatesForWeekdays(array $weekdaysItalian, DateTime $startDate, DateTime $endDate): array {
        $mapDays = [
            'Lunedì'    => 'Monday',
            'Martedì'   => 'Tuesday',
            'Mercoledì' => 'Wednesday',
            'Giovedì'   => 'Thursday',
            'Venerdì'   => 'Friday',
            'Sabato'    => 'Saturday',
            'Domenica'  => 'Sunday',
        ];

        $allDates = [];

        foreach ($weekdaysItalian as $weekdayItalian) {
            if (!isset($mapDays[$weekdayItalian])) {
                // Giorno non valido, salta o gestisci errore
                continue;
            }

            $weekdayEnglish = $mapDays[$weekdayItalian];

            // Trova la prima data di questo giorno
            $current = clone $startDate;
            $current->modify('next ' . $weekdayEnglish);

            // Se startDate è già quel giorno, includilo
            if ($startDate->format('l') === (new DateTime($weekdayEnglish))->format('l')) {
                $current = clone $startDate;
            }

            // Aggiungi tutte le date per questo giorno
            while ($current <= $endDate) {
                $allDates[] = $current->format('Y-m-d');
                $current->modify('+1 week');
            }
        }

        sort($allDates);

        return $allDates;
    }




    private static function getHourlySlots(DateTime $start_time, DateTime $end_time): array {
        $end_limit = clone $end_time;

        $interval = new DateInterval('PT1H');
        $period = new DatePeriod($start_time, $interval, $end_limit);

        $slots = [];
        foreach ($period as $hour) {
            $slots[] = $hour->format('H:i');
        }

        return $slots;
    }





    public static function getCommonAvailableStartTimesForDuration(EField $field,array $dates,int $duration): array {
        $pm = FPersistentManager::getInstance();
        $dailySlots = [];

        foreach ($dates as $dateStr) {
            $date = new DateTime($dateStr);
            $slots = self::retriveAvaiableHoursForFieldAndDate($field->getId(), $date->format('Y-m-d'));
            sort($slots);
            $dailySlots[] = $slots;
        }

        $possibleStartsByDay = [];

        foreach ($dailySlots as $slots) {
            $startTimes = [];
            for ($i = 0; $i <= count($slots) - $duration; $i++) {
                $ok = true;
                $start = DateTime::createFromFormat('H:i:s', $slots[$i]);

                for ($j = 1; $j < $duration; $j++) {
                    $expected = (clone $start)->modify("+{$j} hours")->format('H:i:s');
                    if (!in_array($expected, $slots)) {
                        $ok = false;
                        break;
                    }
                }

                if ($ok) {
                    $startTimes[] = $slots[$i];
                }
            }
            $possibleStartsByDay[] = $startTimes;
        }

        $common = $possibleStartsByDay[0];
        for ($i = 1; $i < count($possibleStartsByDay); $i++) {
            $common = array_intersect($common, $possibleStartsByDay[$i]);
        }

        sort($common);
        return array_values($common);
    }  


    
    public static function generateAndSaveCourseReservations(array $dates, string $startTimeStr, int $duration, EField $field, EUser $instructor): void {
        $pm = FPersistentManager::getInstance();

        foreach ($dates as $dateStr) {
            $date = new DateTime($dateStr);
            $start = DateTime::createFromFormat('Y-m-d H:i:s', $dateStr . ' ' . $startTimeStr);

            for ($i = 0; $i < $duration; $i++) {
                $slotTime = (clone $start)->modify("+{$i} hours");
                $reservation = new EReservation($date, $slotTime, $field, $instructor, new EOnSitePayment());
                $pm::saveReservation($reservation);
            }
        }
    }



    public static function getReservationsOfCourse(ECourse $course): array {
        // Estrai orari dal timeSlot (es. "08:00-10:00")
        list($startTimeStr, $endTimeStr) = explode('-', $course->getTimeSlot());
        $startTime = DateTime::createFromFormat('H:i', $startTimeStr);
        $endTime = DateTime::createFromFormat('H:i', $endTimeStr);

       // Date in cui il corso si svolge
        $dates = self::getDatesForWeekdays($course->getDaysOfWeek(), $course->getStartDate(), $course->getEndDate());

       // Tutte le ore intermedie (es. 08:00, 09:00)
        $hourSlots = self::getHourlySlots($startTime, $endTime);

       // Combinazioni date + ore
        $expectedSlots = [];
        foreach ($dates as $date) {
            foreach ($hourSlots as $time) {
                $expectedSlots[] = ['date' => $date, 'time' => $time];
            }
        }

        // Recupera prenotazioni dell'istruttore
        $reservations = FPersistentManager::getInstance()->retriveReservationsByUserId($course->getInstructor()->getId());

        // Filtra quelle legate al corso
        $matched = [];
        foreach ($reservations as $reservation) {
            $resDate = $reservation->getDate()->format('Y-m-d');
            $resTime = $reservation->getTime()->format('H:i');

            foreach ($expectedSlots as $slot) {
                if ($slot['date'] === $resDate && $slot['time'] === $resTime) {
                    $matched[] = $reservation;
                    break;
                }
            }
        }

        return $matched;
    }

}