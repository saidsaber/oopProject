<?php
namespace App\Traits;
trait Validation
{
    private static function isMin($field, $data)
    {
        if (!isset($_SESSION["error"][$field])) {
            if (strlen($data) < 4) {
                $_SESSION['error'][$field] = "must be more than 4";
            }
        }
    }

    private static function isConfirm($field)
    {
        $fieldconfirm = "confirm-" . $field;
        if (!isset($_SESSION["error"][$field])) {
            if ($_POST[$field] !== $_POST[$fieldconfirm]) {
                $_SESSION['error'][$fieldconfirm] = "the $field is not confirmed";
            }
        }
    }

    private static function isRequired($field, $data)
    {
        if (!isset($_SESSION["error"][$field])) {
            if ($data == null) {
                $_SESSION["error"][$field] = "$field is required";
            }
        }

    }

    private static function isPassword($field, $data)
    {
        if (!isset($_SESSION["error"][$field])) {
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $data)) {
                $_SESSION["error"][$field] = 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';
            }
        }
    }


    private static function isPhone($field, $data)
    {
        if (!isset($_SESSION["error"][$field])) {
            if (!preg_match('/^01[0125][0-9]{8}$/', $data)) {
                $_SESSION['error'][$field] = 'Please enter a valid phone number';
            }
        }
        return true;
    }

    private static function isEmail($field, $data)
    {
        if (!isset($_SESSION['error'][$field])) {
            if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'][$field] = 'Please enter a valid email';
            }
        }
    }

    public static function gender($field, $data)
    {
        $validGenders = ['male', 'female'];
        if (!in_array(strtolower($data), $validGenders)) {
            $_SESSION['error'][$field] = 'this field must be "male" or "female"';
        }
    }

    private static function hasError()
    {
        return (isset($_SESSION["error"]) && !empty($_SESSION["error"])) ? true : false;
    }
}