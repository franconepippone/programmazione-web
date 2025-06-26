<?php
use App\Enum\EnumSport;

require __DIR__ ."/../../vendor/autoload.php";


class UValidate {

    // -------------------------- specific validation methods --------------------------

    /**
     * Validates a birth date string to ensure the user is at least MINIMUM_AGE years old.
     *
     * @param string $dateString The birth date string in 'Y-m-d' format.
     * @return DateTime The validated birth date as a DateTime object.
     * @throws ValidationException If the date is invalid or the user is underage.
     */
    public static function validateBirthDate(string $dateString): DateTime {
        // Validates a birth date string
        $date = self::validateDate($dateString);
        $today = new DateTime();
        $age = $today->diff($date)->y;

        if ($age < MINIMUM_AGE) {
            throw new ValidationException("You must be at least " . MINIMUM_AGE . " years old.");
        }

        return $date;
    }

    /**
     * Validates a name or surname string.
     *
     * The name must:
     * - Be at least 1 character and at most MAX_USERNAME_LENGTH characters long.
     * - Contain only uppercase and lowercase letters (a-z, A-Z).
     * - Not contain spaces, numbers, or special characters.
     *
     * @param string $name The name to validate.
     * @return string The validated name.
     * @throws ValidationException If the name does not meet the requirements.
     */
    public static function validateName(string $name): string {
        // Validates a name string (e.g., first name, last name)
        try {
            return self::validateString($name, 1, MAX_USERNAME_LENGTH, '/^[a-zA-Z]+$/');
        } catch (ValidationException $e) {
            // simply rethrow the exception with a more specific message
            $errcode = $e->getCode();
            switch ($errcode) {
                case -1:
                    throw new ValidationException("Name must be at least 1 character long.", code: $errcode);
                case -2:
                    throw new ValidationException("Name must not exceed " . MAX_USERNAME_LENGTH . " characters.", code: $errcode);
                default:
                    throw new ValidationException("Name can only contain letters (a-z, A-Z).", code: $errcode);
            }
        }
    }

    /**
     * Validates a username string to ensure it meets minimum security requirements.
     *
     * The username must:
     * - Be at least 3 characters and at most 20 characters long.
     * - Contain only letters, digits, underscores, and hyphens.
     * - Start with a letter.
     * 
     * @param string $username The username string to validate.
     * @return string The validated username.
     * @throws ValidationException If the username does not meet the requirements.
     */
    public static function validateUsername(string $username): string {
        // Validates a username string
        try {
            return self::validateString($username, 3, MAX_USERNAME_LENGTH, '/^[a-zA-Z][a-zA-Z0-9\-_]{2,19}$/');
        } catch (ValidationException $e) {
            // simply rethrow the exception with a more specific message
            $errcode = $e->getCode();
            switch ($errcode) {
                case -1:
                    throw new ValidationException("Username must be at least 3 characters long.", code: $errcode);
                case -2:
                    throw new ValidationException("Username must not exceed " . MAX_USERNAME_LENGTH . " characters.", code: $errcode);
                default:
                    throw new ValidationException("Username must start with a letter and can only contain letters, digits, underscores, and hyphens.", code: $errcode);
            }
        }
    }

    /**
     * Validates a password string to ensure it meets minimum security requirements.
     *
     * The password must:
     * - Be at least 8 characters and at most 255 characters long.
     * - Contain at least one lowercase letter, one uppercase letter, and one digit.
     * - Contain only letters and digits (no special symbols allowed).
     *
     * This method uses a regular expression to enforce the above rules.
     * If the password does not meet the requirements, a ValidationException is thrown.
     *
     * @param string $password The password string to validate.
     * @return string The validated password.
     * @throws ValidationException If the password does not meet the requirements.
     */
    public static function validatePassword(string $password): string {
        try {
            return self::validateString($password, 8, 255, 
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*()_\-+=]{8,}$/');
        } catch (ValidationException $e) {
            // simply rethrow the exception with a more specific message
            $errcode = $e->getCode();
            switch ($errcode) {
                case -1:
                    throw new ValidationException("Password must be at least 8 characters long.", code: $errcode);
                case -2:
                    throw new ValidationException("Password must not exceed 255 characters.", code: $errcode);
                default:
                    throw new ValidationException("Password must contain at least one uppercase letter, one lowercase letter, and one digit.", code: $errcode);
            }
        }
    }

    public static function validateSport($string): string {
        try {
            return self::validateEnum($string, EnumSport::class);
        } catch (ValidationException $e) {
            // Rethrow with a more specific message
            throw new ValidationException("Invalid sport: '$string'. " . $e->getMessage(), code: $e->getCode());
        }
    }



    // -------------------------- general purpose validation methods --------------------------

    /**
     * Validate if a string corresponds to a backed enum value (case-insensitive).
     *
     * @param string $value Input string to validate
     * @param class-string<\BackedEnum> $enumClass Enum class name
     * @return string Validated enum value (normalized)
     * @throws ValidationException If value is not valid for the enum
     */
    public static function validateEnum(string $value, string $enumClass): string {
        if (!enum_exists($enumClass)) {
            throw new \InvalidArgumentException("Class '$enumClass' is not a valid enum.");
        }

        $normalized = strtolower(trim($value));

        foreach ($enumClass::cases() as $case) {
            if (strtolower($case->value) === $normalized) {
                return $case->value;
            }
        }

        throw new ValidationException("Invalid value '$value' for enum '$enumClass'.");
    }

    public static function validateDate(string $dateString): DateTime {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        $errors = DateTime::getLastErrors() ?: ['warning_count' => 0, 'error_count' => 0];

        if (!$date || $errors['warning_count'] > 0 || $errors['error_count'] > 0) {
            throw new ValidationException("Invalid date: '$dateString'");
        }

        return $date;
    }

    /**
     * Validates a time string in the format 'H:i' (e.g., '14:30').
     * @param string $timeString
     * @return DateTime
     * @throws ValidationException
     */
    public static function validateTime(string $timeString): DateTime {
        $time = DateTime::createFromFormat('H:i', $timeString);
        $errors = DateTime::getLastErrors() ?: ['warning_count' => 0, 'error_count' => 0];

        if (!$time || $errors['warning_count'] > 0 || $errors['error_count'] > 0) {
            throw new ValidationException("Orario non valido: '$timeString'");
        }

        return $time;
    }

    /**
     * Validates an email address.
     *
     * @param string $email The email address to validate.
     * @return string The validated email address.
     * @throws ValidationException If the email address is invalid.
     */
    public static function validateEmail(string $email): string {
        // Usa FILTER_VALIDATE_EMAIL per validare la struttura
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("Email non valida: '$email'");
        }

        // Eventuali controlli aggiuntivi (es. dominio con record MX)
        // if (!checkdnsrr(substr(strrchr($email, '@'), 1), 'MX')) {
        //     throw new ValidationException("Dominio email inesistente: '$email'");
        // }

        return $email;
    }

    /**
     * Validates a generic string with customizable length and pattern constraints.
     *
     * This method checks that the input string meets the specified minimum and maximum length,
     * and optionally matches a given regular expression pattern.
     *
     * Note: This function is not intended to be called directly from input handling code (e.g., validateInputArray).
     * It is designed to be used inside more specific validation methods (such as validateTitle, validateUsername, etc.)
     * to enforce common string validation logic.
     *
     * @param string $input      The input string to validate.
     * @param int $minLength     Minimum allowed length (default: 1).
     * @param int $maxLength     Maximum allowed length (default: 255).
     * @param string|null $pattern Optional regex pattern the string must match (default: alphanumeric and basic punctuation).
     * @return string            The validated string.
     * @throws ValidationException If the string does not meet the requirements.
     */
    public static function validateString(
        string $input,
        int $minLength = 1,
        int $maxLength = 255,
        ?string $pattern = '/^[a-zA-Z0-9\s\-\_\.]+$/'
    ): string {
        // controls if the input is empty
        $length = strlen($input);
        if ($length < $minLength) {
            throw new ValidationException("Il testo deve essere lungo almeno $minLength caratteri.", code: -1);
        }
        if ($length > $maxLength) {
            throw new ValidationException("Il testo non può superare $maxLength caratteri.", code: -2);
        }

        // Controlla pattern, se specificato
        if ($pattern && !preg_match($pattern, $input)) {
            throw new ValidationException("Il formato del testo non è valido: $input", code: -3);
        }

        return $input;
    }
        
    /**
     * Validates and filters an input array based on allowed attributes and custom validation methods.
     *
     * @param array $input            The input array to be validated (e.g. $_GET, $_POST).
     * @param array $validationRules  Associative array where keys are accepted attribute names and values are the corresponding validation method names.
     * @param bool  $require          Whether all listed attributes are required (default: false).
     *
     * @return array                  The sanitized and validated array containing only allowed and validated parameters.
     *
     * @throws ValidationException    If required attributes are missing and $require is true, or if validation fails.
     *
     * This function:
     * - Removes keys that are not in $validationRules or have empty values.
     * - Trims and escapes each valid input.
     * - Throws an exception if required attributes are missing.
     * - Calls the corresponding static validation method (e.g., validateTitle for 'title') for each parameter.
     */
    public static function validateInputArray(array $input, array $validationRules, bool $require = false): array {
        $filteredParams = $input;
        $fieldNames = array_keys($validationRules);

        foreach (array_keys($filteredParams) as $key) {
            if (!in_array($key, $fieldNames)) {
                unset($filteredParams[$key]);
            } else {
                if (is_array($filteredParams[$key])) {
                    if (count($filteredParams[$key]) === 0) {
                        unset($filteredParams[$key]);
                        continue;
                    }
                    $filteredParams[$key] = array_map(
                        fn($v) => is_string($v) ? htmlspecialchars(trim($v)) : $v,
                        $filteredParams[$key]
                    );
                } else {
                    if (trim($filteredParams[$key]) === '') {
                        unset($filteredParams[$key]);
                        continue;
                    }
                    $filteredParams[$key] = htmlspecialchars(trim($filteredParams[$key]));
                }
                $fieldNames = array_filter($fieldNames, fn($value) => $value !== $key);
            }
        }

        if ($require && !empty($fieldNames)) {
            throw new ValidationException(
                "Missing required parameters.",
                details: ["params" => implode(', ', $fieldNames)]
            );
        }

        foreach ($filteredParams as $key => $val) {
            $validationMethod = $validationRules[$key];
            $filteredParams[$key] = self::{$validationMethod}($val);
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
            throw new ValidationException("Il numero di partecipanti deve essere compreso tra 1 e 1000.");
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
            throw new ValidationException("Il prezzo deve essere un numero positivo.");
        }
        return round(floatval($price), 2);
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
            throw new ValidationException("Il corso deve iniziare almeno tra 7 giorni.");
        }
        return $startDate;
    }

    /**
     * Validates the course end date.
     *
     * Must be after the given start date.
     */
    public static function validateEndDate(string $endDateString, ?string $startDateString = null): DateTime {
        $endDate = self::validateDate($endDateString);
        if ($startDateString) {
            $startDate = self::validateDate($startDateString);
            if ($endDate <= $startDate) {
                throw new ValidationException("La data di fine deve essere successiva a quella di inizio.");
            }
        }
        return $endDate;
    }

    /**
     * Validates the instructor ID.
     *
     * Must be a positive integer corresponding to an existing instructor in the database.
     */
    public static function validateInstructorId($id) {
        $id = intval($id);
        if ($id <= 0) {
            throw new ValidationException("ID istruttore non valido.");
        }
        $pm = FPersistentManager::getInstance();
        $instructor = $pm->retriveInstructorById($id);
        if (!$instructor) {
            throw new ValidationException("Istruttore non trovato.");
        }
        return $id;
    }

    public static function validateDays(array $days): array {
        $allowed = ['Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato','Domenica'];
        foreach ($days as $day) {
            if (!in_array($day, $allowed)) {
                throw new ValidationException("Giorno della settimana non valido: '$day'.");
            }
        }
        return $days;
    }

    public static function validateFieldId($id) {
        $id = intval($id);
        if ($id <= 0) {
            throw new ValidationException("ID campo non valido.");
        }
        $pm = FPersistentManager::getInstance();
        $field = $pm->retriveFieldById($id);
        if (!$field) {
            throw new ValidationException("Campo non trovato.");
        }
        return $id;
    }
}
