<?php


require __DIR__ ."/../../vendor/autoload.php";


class UValidate {

    //-------------------------------- PUT HERE THE VALIDATOR METHODS ------------------------------

    // ------ ONLINE PAYMENTS -----------

    public function validatePaymentMethod($method): string {
        return "";
    }

    /**
     * Validate if a string is a valid email address
     * @param string $email
     * @return bool
     */
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    #[ValidatorFor("title")]
    public static function validateTitle(string $title): string {
        // Check if the title is empty
        if (empty($title)) {
            throw new ValidationException("Title is empty");
        }
        // Check if the title is too long
        if (strlen($title) > 100) {
            throw new ValidationException("Title exceeds character limit.");
        }
        // Check if the title contains only valid characters (letters, numbers, spaces, and some special characters)
        if (!preg_match('/^[a-zA-Z0-9\s\-\_\.]+$/', $title)) {
            throw new ValidationException("Title contains invalid characters");
        }
        return $title;
    }
    
    // --------------------------- DO NOT CHANGE -----------------------------------------

    /**
     * Validates and filters an input array based on allowed attributes and custom validation methods.
     *
     * @param array $array       The input array to be validated (e.g. $_GET, $_POST).
     * @param array $attributes  List of accepted attribute keys. Missing required attributes will trigger an exception if $require is true.
     * @param bool  $require     Whether all listed attributes are required (default: false).
     *
     * @return array             The sanitized and validated array with only allowed parameters.
     *
     * @throws ValidationException If required attributes are missing and $require is true.
     *
     * The function:
     * - Removes keys not in $attributes or with empty values.
     * - Trims and escapes each valid input.
     * - Invokes corresponding static validation methods (e.g., validateTitle for 'title') if they exist.
     */
    public static function validateInputArray(array $array, array $attributes, bool $require = false): array {
        $filteredParams = $array;

        // Remove any keys not listed in $attributes or that are empty
        foreach (array_keys($filteredParams) as $key) {
            if (!in_array($key, $attributes) || empty($filteredParams[$key])) {
                unset($filteredParams[$key]);
            } else {
                $filteredParams[$key] = htmlspecialchars(trim($filteredParams[$key]));
                unset($attributes[$key]); // Mark this attribute as handled
            }
        }

        // If required attributes are missing, throw a validation error
        if ($require && !empty($attributes)) {
            throw new ValidationException(
                "Missing required parameters.",
                details: ["params" => implode(', ', $attributes)]
            );
        }

        // Apply field-specific validation using #[ValidatorFor(...)] annotations
        $validatorMap = self::getValidatorMap();

        foreach ($filteredParams as $key => $val) {
            if (isset($validatorMap[$key]) && method_exists(self::class, $validatorMap[$key])) {
                $filteredParams[$key] = self::{$validatorMap[$key]}($val);
            }
        }

        return $filteredParams;
    }

    private static function getValidatorMap(): array {
        $validators = [];
        $reflection = new \ReflectionClass(self::class);

        foreach ($reflection->getMethods(\ReflectionMethod::IS_STATIC) as $method) {
            foreach ($method->getAttributes(ValidatorFor::class) as $attr) {
                /** @var ValidatorFor $instance */
                $instance = $attr->newInstance();
                // for each field in validatorFor fields, add an entry to the table
                foreach ($instance->fields as $field) {
                    $validators[$field] = $method->getName();
                }
            }
        }

        return $validators;
    }
}


/**
 * Attribute to declare which input fields a static validation method applies to.
 *
 * Usage:
 *     #[ValidatorFor("field_name")]
 *     public static function validateFieldName(string $value): string { ... }
 *
 * You can specify multiple fields if the same method handles them:
 *     #[ValidatorFor("field_a", "field_b")]
 *
 * This attribute is intended to be used on static methods of a validation class.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class ValidatorFor {
    /**
     * The list of input field names this method validates.
     *
     * @var string[]
     */
    public array $fields;

    /**
     * Constructor accepting one or more input field names.
     *
     * @param string ...$fields The input field(s) this method validates
     */
    public function __construct(string ...$fields) {
        $this->fields = $fields;
    }
}