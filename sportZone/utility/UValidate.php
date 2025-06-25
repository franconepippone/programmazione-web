<?php

use App\Enum\EnumSport;

require __DIR__ ."/../../vendor/autoload.php";


class UValidate {

    // -------------------------- specific validation methods --------------------------

    public static function validateSport($string): string {
        return self::validateEnum($string, EnumSport::class);
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
            throw new ValidationException("Invalid time: '$timeString'");
        }

        return $time;
    }

    /**
     * Validate if a string is a valid email address
     * @param string $email
     * @return bool
     */
    public static function validateEmail(string $email): string {
        // Usa FILTER_VALIDATE_EMAIL per validare la struttura
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("Invalid email: '$email'");
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
            throw new ValidationException("length be at least $minLength characters.");
        }
        if ($length > $maxLength) {
            throw new ValidationException("length must not exceed $maxLength characters.");
        }

        // Controlla pattern, se specificato
        if ($pattern && !preg_match($pattern, $input)) {
            throw new ValidationException("string contains invalid characters.");
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
            // Rimuovo i parametri che non sono tra quelli definiti
            if (!in_array($key, $fieldNames) || empty($filteredParams[$key]) ) {
                unset($filteredParams[$key]);
            } else {
                $filteredParams[$key] = htmlspecialchars(trim($filteredParams[$key]));
                $fieldNames = array_filter($fieldNames, fn($value) => $value !== $key);
                //unset($fieldNames[$key]); // attribute found, we dont need it in the attributes array anymore*
            }
        }

        // throws exceptions if some attributes are still missing and the $require flag is true
        if ($require && !empty($fieldNames)) {
            throw new ValidationException(
                "Missing required parameters.",
                details: ["params" => implode(', ', $fieldNames)]
            );
        }
        
        foreach ($filteredParams as $key => $val) {
            $validationMethod = $validationRules[$key];
            $filteredParams[$key] = self::$validationMethod($val);
        }

        return $filteredParams;
    }
}
