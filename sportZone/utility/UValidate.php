<?php
use App\Enum\EnumSport;
use App\Enum\UserSex;;

require __DIR__ ."/../../vendor/autoload.php";

/**
 * UValidate
 *
 * Utility class providing static methods for validating and sanitizing user input.
 *
 * The main entry point for input validation is the static method {@see UValidate::validateInputArray()}.
 * This method is used throughout the application (see controllers like COnlinePayment and CField)
 * to validate and sanitize arrays such as $_POST and $_GET, based on a set of rules.
 *
 * Usage example:
 *   $inputs = UValidate::validateInputArray($_POST, [
 *       "number" => 'validateCreditCardNumber',
 *       "expirationDate" => 'validateFutureDate',
 *       "cardNetwork" => 'validateCardNetwork',
 *       "bank" => 'validateBank',
 *       "cvv" => 'validateCVV',
 *       "owner" => 'validateFullName'
 *   ], true);
 *
 * Each rule maps a field name to a static validation method of this class.
 * The method will:
 *   - Remove keys not in the rules or with empty values
 *   - Trim and escape each valid input
 *   - Throw an exception if required attributes are missing (when $require is true)
 *   - Call the corresponding static validation method for each parameter
 *   - Return an array of validated and sanitized values, possibly with type conversion (e.g. DateTime)
 *
 * All validation methods throw ValidationException on error.
 *
 * @package sportZone\utility
 */
class UValidate {

    // -------------------------- credit card validation --------------------------


    /**
     * Validates a currency amount string to ensure it is a valid decimal number.
     *
     * The amount must:
     * - Be a valid decimal number (e.g., "10.00", "100.50").
     * - Not be negative.
     *
     * @param string $amount The currency amount to validate.
     * @return int The validated currency amount in cents.
     * @throws ValidationException If the amount is invalid or negative.
     */
    public static function validateCurrencyAmount(string $amount): int {
        // Validates a currency amount string
        $amount = preg_replace('/[^\d.]/', '', $amount); // Remove non-numeric characters except dot

        if (!is_numeric($amount) || $amount < 0) {
            throw new ValidationException("Invalid currency amount: '$amount'. Must be a positive decimal number.");
        }

        // Convert to cents (int)
        return (int) round(((float)$amount) * 100);
    }

    /*     * Validates a credit card number using the Luhn algorithm.
     *
     * @param string $number The credit card number to validate.
     * @return string The validated credit card number.
     * @throws ValidationException If the credit card number is invalid.
     */
    public static function validateCreditCardNumber(string $number): string {
        // Validates a credit card number using Luhn algorithm
        $number = preg_replace('/\D/', '', $number); // Remove non-digit characters

        if (strlen($number) < 13 || strlen($number) > 19) {
            throw new ValidationException("Invalid credit card number length.");
        }

        $sum = 0;
        $alt = false;

        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $n = (int)$number[$i];

            if ($alt) {
                $n *= 2;
                if ($n > 9) {
                    $n -= 9;
                }
            }

            $sum += $n;
            $alt = !$alt;
        }

        if ($sum % 10 !== 0) {
            throw new ValidationException("Invalid credit card number.");
        }

        return $number;
    }
    
    /**
     * Validates a CVV (Card Verification Value) for credit cards.
     *
     * @param string $cvv The CVV to validate.
     * @return string The validated CVV.
     * @throws ValidationException If the CVV is invalid.
     */
    public static function validateCVV(string $cvv): string {
        // Validates a CVV (Card Verification Value)
        $cvv = preg_replace('/\D/', '', $cvv); // Remove non-digit characters

        if (strlen($cvv) < 3 || strlen($cvv) > 4) {
            throw new ValidationException("Invalid CVV length. Must be 3 or 4 digits.");
        }

        return $cvv;
    }


    /**
     * Validates a bank name string.
     *
     * The bank name must:
     * - Be at least 1 character and at most MAX_USERNAME_LENGTH characters long.
     * - Contain only letters, digits, spaces, and basic punctuation (.,-).
     *
     * @param string $bankName The bank name to validate.
     * @return string The validated bank name.
     * @throws ValidationException If the bank name does not meet the requirements.
     */
    public static function validateBank(string $bankName): string {
        // Validates a bank name string
        try {
            return self::validateString($bankName, 1, 250, '/^[a-zA-Z0-9\s\.,-]+$/');
        } catch (ValidationException $e) {
            // simply rethrow the exception with a more specific message
            $errcode = $e->getCode();
            switch ($errcode) {
                case -1:
                    throw new ValidationException("Bank name must be at least 1 character long.", code: $errcode);
                case -2:
                    throw new ValidationException("Bank name must not exceed " . MAX_USERNAME_LENGTH . " characters.", code: $errcode);
                default:
                    throw new ValidationException("Bank name can only contain letters, digits, spaces, and basic punctuation (.,-).", code: $errcode);
            }
        }

        // TODO maybe check if the bank name exists in a predefined list of banks
    }   
    
    /**
     * Validates a card network string against a list of accepted card networks.
     *
     * The card network must be one of the following (case-sensitive):
     * - Visa
     * - MasterCard
     * - American Express
     * - Discover
     * - Diners Club
     * - JCB
     *
     * @param string $network The card network to validate.
     * @return string The validated card network.
     * @throws ValidationException If the card network is not in the list of accepted values.
     */
    public static function validateCardNetwork(string $network): string {
        // Validates a card network (e.g., Visa, MasterCard, etc.)
        $validNetworks = ['Visa', 'MasterCard', 'American Express', 'Discover', 'Diners Club', 'JCB'];

        if (!in_array($network, $validNetworks)) {
            throw new ValidationException("Invalid card network: '$network'.");
        }

        return $network;
    }


    // -------------------------- other specific validation methods --------------------------

    /**
     * Validates a future date string to ensure it is in the future.
     *
     * @param string $dateString The date string in 'Y-m-d' format.
     * @return DateTime The validated date as a DateTime object.
     * @throws ValidationException If the date is invalid or not in the future.
     */
    public static function validateFutureDate(string $dateString): DateTime {
        // Validates a future date string in 'Y-m' format (year and month)
        $date = DateTime::createFromFormat('Y-m', $dateString);
        $errors = DateTime::getLastErrors() ?: ['warning_count' => 0, 'error_count' => 0];

        if (!$date || $errors['warning_count'] > 0 || $errors['error_count'] > 0) {
            throw new ValidationException("Invalid date: '$dateString'");
        }

        // Set to the first day of the month for comparison
        $today = new DateTime('first day of this month');

        if ($date < $today) {
            throw new ValidationException("The date must be in the future.");
        }

        return $date;
    }

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

        if ($date > $today) {
            throw new ValidationException("La data non può essere nel futuro.");
        }

        $age = $today->diff($date)->y;

        if ($age < MINIMUM_AGE) {
            throw new ValidationException("Devi avere almeno " . MINIMUM_AGE . " anni.");
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
    public static function validateFieldName(string $name): string {
    // Accetta lettere, numeri, spazi e trattini, lunghezza 2-100 caratteri
    return self::validateString($name, 2, 100, '/^[a-zA-Z0-9\s\-]+$/');
}

    // validate fulls name (name + space + surname)
    public static function validateFullName(string $fullName): string {
        // Validates a full name string (e.g., first name + last name)
        try {
            return self::validateString($fullName, 1, MAX_USERNAME_LENGTH, '/^[a-zA-Z]+( [a-zA-Z]+)*$/');
        } catch (ValidationException $e) {
            // simply rethrow the exception with a more specific message
            $errcode = $e->getCode();
            switch ($errcode) {
                case -1:
                    throw new ValidationException("Full name must be at least 1 character long.", code: $errcode);
                case -2:
                    throw new ValidationException("Full name must not exceed " . MAX_USERNAME_LENGTH . " characters.", code: $errcode);
                default:
                    throw new ValidationException("Full name can only contain letters and spaces.", code: $errcode);
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
            return self::validateString($password, 8, 32, 
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*()_\-+=]{8,}$/');
        } catch (ValidationException $e) {
            // simply rethrow the exception with a more specific message
            $errcode = $e->getCode();
            switch ($errcode) {
                case -1:
                    throw new ValidationException("La password deve essere lunga almeno 8 caratteri.", code: $errcode);
                case -2:
                    throw new ValidationException("La password non può superare 32 caratteri.", code: $errcode);
                default:
                    throw new ValidationException("La password deve contenere almeno una lettera maiuscola, una lettera minuscola e una cifra.", code: $errcode);
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
    
    public static function validateGender(string $sex): string {
        try {
            return self::validateEnum($sex, UserSex::class);
        } catch (ValidationException $e) {
            // Rethrow with a more specific message
            throw new ValidationException("Invalid gender: '$sex'. " . $e->getMessage(), code: $e->getCode());
        }
    }

    // -------------------------- general purpose validation methods --------------------------

    /**
     * Validates an ID to ensure it is a positive integer.
     *
     * @param mixed $id The ID to validate.
     * @return int The validated ID as an integer.
     * @throws ValidationException If the ID is not a positive integer.
     */
    public static function validateId($id) {
        $id = intval($id);
        if ((!is_numeric($id)||!is_integer($id)||$id <= 0 )) {
            throw new ValidationException("ID non valido.");
        }
        return $id;
    }

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

    public static function skipValidation($input) {
        // This method is used to skip validation for specific parameters
        // It simply returns the input as is, without any checks
        return $input;
    }
        
      /**
     * Validates that the given date is not in the past.
     *
     * @param string $dateString The date string in 'Y-m-d' format.
     * @return string The validated date as a string.
     * @throws ValidationException If the date is invalid or in the past.
     */
    public static function validateNotInPast(string $dateString): string {
        $inputDate = self::validateDate($dateString);
        $today = new DateTime();
        $today->setTime(0, 0, 0); // Azzeriamo l'orario per confrontare solo le date

        if ($inputDate < $today) {
            throw new ValidationException("La data non può essere nel passato.");
        }
        return $inputDate->format('Y-m-d');
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
                "Parametri richiesti mancanti",
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
        if (!is_numeric($num)|| $val < 1 || $val > 1000) {
            throw new ValidationException("Number of participants must be a number between 1 and 1000.");
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
        if ((!is_numeric($id)||!is_integer($id)||$id <= 0 )) {
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

  
    // -------------------------- reservation validation methods --------------------------


    /**
    * Valida l'ID della reservation.
    *
     * Deve essere un intero positivo corrispondente a una reservation esistente nel database.
     */
    public static function validateReservationId($id) {
        $id = intval($id);
        if ($id <= 0) {
            throw new ValidationException("ID prenotazione non valido.");
        }
        $pm = FPersistentManager::getInstance();
        $reservation = $pm->retriveReservationById($id);
        if (!$reservation) {
            throw new ValidationException("Prenotazione non trovata.");
        }
        return $id;
    }


    /**
     * Valida la data della reservation (deve essere una data valida e non nel passato).
     */
    public static function validateReservationDate(string $dateString): string {
        $date = self::validateDate($dateString);
        $today = new DateTime('today');
        $maxDate = (clone $today)->modify('+7 days');
        if ($date < $today) {
            throw new ValidationException("La data della prenotazione non può essere nel passato.");
        }
        if ($date > $maxDate) {
            throw new ValidationException("Puoi prenotare solo entro i prossimi 7 giorni.");
        }
        return $date->format('Y-m-d'); // restituisce una stringa
    }

    /**
     * Valida l'orario della reservation (deve essere un orario valido).
     */
    public static function validateReservationTime(string $timeString): string {
        $time = self::validateTime($timeString);
        return $time->format('H:i'); // restituisce una stringa
    }

    /**
     * Verifica se il client ha già una reservation attiva (oggi o futura).
     * Lancia una ValidationException se ne trova una.
     */
    public static function validateNoActiveReservation($clientId) {
        $today = new DateTime('today');
        $reservations = FPersistentManager::getInstance()->retriveReservationsByUserId($clientId);
        $user = FPersistentManager::getInstance()->retriveUserById($clientId);
        if ($user->getType() != 'client') {
            return true;
        }
        if (!$reservations) {
            return true;
        }
        foreach ($reservations as $res) {
            if ($res->getDate() >= $today) {
                throw new ValidationException("Hai già una prenotazione attiva. Puoi prenotare di nuovo solo dopo che la precedente è scaduta.");
            }
        }
        return true;
    }

    /**
     * Valida l'ID del client.
     *
     * Deve essere un intero positivo corrispondente a un client esistente nel database.
     */
    public static function validateClientId($id) {
        $id = intval($id);
        if ($id <= 0) {
            throw new ValidationException("ID cliente non valido.");
        }
        $pm = FPersistentManager::getInstance();
        $client = $pm->retriveClientById($id);
        if (!$client) {
            throw new ValidationException("Cliente non trovato.");
        }
        return $id;
    //************************************************************************ */
    }
    public static function validateTimeSlot(string $timeSlot): string {
        // Accetta formato "HH:MM-HH:MM"
        if (!preg_match('/^\d{2}:\d{2}-\d{2}:\d{2}$/', $timeSlot)) {
            throw new ValidationException("Formato fascia oraria non valido. Usa HH:MM-HH:MM.");
        }
        // Controllo opzionale: orario di inizio < orario di fine
        [$start, $end] = explode('-', $timeSlot);
        $startTime = self::validateTime($start);
        $endTime = self::validateTime($end);
        if ($startTime >= $endTime) {
            throw new ValidationException("L'orario di inizio deve precedere quello di fine.");
        }
        return $timeSlot;
    }

}
   
