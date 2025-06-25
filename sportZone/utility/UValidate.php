<?php
require __DIR__ ."/../../vendor/autoload.php";

class UValidate {

    /**
     * Validate if a string is a valid email address
     * @param string $email
     * @return bool
     */
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }


    public static function validateReservationData(string $data): \DateTimeInterface {
        return new \DateTimeImmutable($data);
    }
    


    /// TETSTTSTST
    public static function validateInputArray(array $array, array $attributes, bool $require = false): array {
        $filteredParams = $array;

        $paramskeys = array_keys($filteredParams);
        foreach ($paramskeys as $key) {
            if (!in_array($key, $attributes)) {
                unset($filteredParams[$key]);
            } else {
                // Se il parametro è valido, lo filtro 
                if (is_array($filteredParams[$key])) {
                    // Se è un array vuoto, consideralo mancante
                    if (count($filteredParams[$key]) === 0) {
                        unset($filteredParams[$key]);
                        continue;
                    }
                    $filteredParams[$key] = array_map(
                        fn($v) => is_string($v) ? htmlspecialchars(trim($v)) : $v,
                        $filteredParams[$key]
                    );
                } else {
                    // Se è stringa vuota, consideralo mancante
                    if (trim($filteredParams[$key]) === '') {
                        unset($filteredParams[$key]);
                        continue;
                    }
                    $filteredParams[$key] = htmlspecialchars(trim($filteredParams[$key]));
                }
                // Rimuovo la chiave da $attributes solo se il parametro è valido e non vuoto
                $attrIndex = array_search($key, $attributes);
                if ($attrIndex !== false) {
                    unset($attributes[$attrIndex]);
                }
            }
        }

        echo empty($attributes);

        // throws exceptions if some attributes are still missing and the $require flag is true
        if ($require && !empty($attributes)) {
            throw new ValidationException(
                "Missing required parameters.",
                details: ["params" => implode(', ', $attributes)]
            );
        }

        //qui ho una array di parametri che possono richiamare i metodi di validazione
        //per validare i parametri di ricerca
        foreach ($filteredParams as $key => $val) {
            $methodName = 'validate' . ucfirst($key); // Es: 'title' -> 'validateTitle'
            
            if (method_exists(self::class, $methodName)) {
                // Richiama il metodo statico passando il valore dell'attributo
                $filteredParams[$key] = UValidate::$methodName($filteredParams[$key]);
            }
        }

        return $filteredParams;
    }
    // -------------------------- course creation validation methods --------------------------

    /**
     * These methods are designed to validate user input related to course creation,
     * enforcing domain-specific business rules. The validation includes:
     *
     * - Title: must be between 3 and 100 characters, alphanumeric with spaces, dashes, apostrophes, dots.
     * - Description: must be between 10 and 1000 characters.
     * - Max participants: must be an integer between 1 and 1000.
     * - Price: must be a non-negative number with up to two decimal places.
     * - Days of the week: must be valid weekday names.
     * - Start date: must be a valid date at least 7 days from today.
     * - End date: must be a valid date strictly after the start date.
     * - Instructor ID: must exist in the database, verified through PersistentManager and FInstructor.
     */

    /**
     * Validates the course title.
     */
    public static function validateTitle(string $title): string {
        return self::validateString($title, 3, 100, '/^[a-zA-Z0-9\s\-\'\.]+$/');
    }

    /**
     * Validates the course description.
     */
    public static function validateDescription(string $description): string {
        return self::validateString($description, 10, 1000);
    }

    /**
     * Validates the number of participants.
     *
     * Must be an integer between 1 and 1000.
     */
    public static function validateMaxParticipants(string|int $num): int {
        $val = intval($num);
        if ($val < 1 || $val > 1000) {
            throw new ValidationException("Number of participants must be between 1 and 1000.");
        }
        return $val;
    }

    /**
     * Validates the course price.
     *
     * Must be a non-negative float.
     */
    public static function validatePrice(string|float $price): float {
        if (!is_numeric($price) || floatval($price) < 0) {
            throw new ValidationException("Price must be a non-negative number.");
        }
        return round(floatval($price), 2);
    }

    /**
     * Validates the selected days of the week.
     *
     * All days must be valid weekday names.
     */
    public static function validateDays(array $days): array {
        $allowed = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];
        foreach ($days as $day) {
            if (!in_array($day, $allowed)) {
                throw new ValidationException("Giorno della settimana non valido: '$day'.");
            }
        }
        return $days;
    }

    /**
     * Validates the course start date.
     *
     * Must be at least 7 days in the future.
     */
    public static function validateStartDate(string $dateString): DateTime {
        $startDate = self::validateDate($dateString);
        $today = new DateTime();
        $minStartDate = (clone $today)->modify('+7 days');

        if ($startDate < $minStartDate) {
            throw new ValidationException("Course must start at least 7 days from today.");
        }

        return $startDate;
    }

    /**
     * Validates the course end date.
     *
     * Must be after the given start date.
     */
    public static function validateEndDate(string $endDateString, DateTime $startDate): DateTime {
        $endDate = self::validateDate($endDateString);

        if ($endDate <= $startDate) {
            throw new ValidationException("End date must be after the start date.");
        }

        return $endDate;
    }

    /**
     * Validates the instructor ID.
     *
     * Must be a positive integer corresponding to an existing instructor in the database.
     */
    public static function validateInstructorId(string|int $id): int {
        $id = intval($id);
        if ($id <= 0) {
            throw new ValidationException("Invalid instructor ID.");
        }

        $pm = FPersistentManager::getInstance();
        $instructor = $pm->load('FInstructor', $id);

        if (!$instructor) {
            throw new ValidationException("Instructor with ID $id does not exist.");
        }

        return $id;
    }

    public static function validateTime(string $time): string {
        if (!preg_match('/^\d{2}:\d{2}$/', $time)) {
            throw new ValidationException("Orario non valido.");
        }
        return $time;
    }

    public static function validateFieldId(string|int $id): int {
        $id = intval($id);
        if ($id <= 0) {
            throw new ValidationException("Invalid field ID.");
        }
        $pm = FPersistentManager::getInstance();
        $field = $pm->load('FField', $id);
        if (!$field) {
            throw new ValidationException("Field with ID $id does not exist.");
        }
        return $id;
    }

    public static function validateString(
        string $value,
        int $minLength = 1,
        int $maxLength = 255,
        string $pattern = null
    ): string {
        $value = trim($value);
        if (mb_strlen($value) < $minLength || mb_strlen($value) > $maxLength) {
            throw new ValidationException("Il testo deve essere tra $minLength e $maxLength caratteri.");
        }
        if ($pattern && !preg_match($pattern, $value)) {
            throw new ValidationException("Il formato del testo non è valido.");
        }
        return $value;
    }
}