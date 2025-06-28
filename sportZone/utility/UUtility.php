<?php
class UUtility {

    



    public static function dateSlot($start, $end) {
        // Controlla che l'orario di inizio sia prima di quello di fine
        if ($start >= $end) {
            throw new ValidationException("La data di inizio deve essere prima della data di fine.");
        }
        return true;
    }
    // metodo per serializzare un corso in un array
    





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
            $slots = $pm->retriveAvaiableHoursForFieldAndDate($field->getId(), $date->format('Y-m-d'));
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

}