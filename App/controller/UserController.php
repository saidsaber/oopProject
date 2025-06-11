<?php
namespace App\Controller;
session_start();
require_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/book_store/vendor/autoload.php'));
use App\Traits\Validation;
use PDO;
use PDOException;
class UserController
{
    use Validation;
    private $userId;
    private $name;
    private $email;
    private $gender;
    private $phone;
    private $address;

    public function __construct($userId, $name, $email)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
        // $this->gender = $gender;
        // $this->phone = $phone;
        // $this->address = $address;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function checkPassword()
    {
        // if(password_verify($inputPassword, $hashedPassword))
    }
    public static function createUser($db, $name, $email, $password)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        self::isMin('name', $name);
        self::isEmail('email', $email);
        self::isPassword('password', $password);
        foreach ($data as $key => $value) {
            self::isRequired($key, $value);
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if (self::hasError() == false) {
            $sql = 'INSERT INTO `user`(`UserFirstName`, `UserEmail`, `UserPassword`) VALUES (:UserFirstName  , :email , :password)';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':UserFirstName' => $name,
                ':email' => $email,
                ':password' => $hash
            ]);
            $id = $db->lastInsertId();
            $_SESSION['user'] = $id;
            return new self($id, $name, $email);
        } else {
            return false;
        }
    }

    public static function updateData($db, $name, $email, $id)
    {
        unset($_SESSION['error']);
        $data = [
            'name' => $name,
            'email' => $email,
        ];
        self::isMin('name', $name);
        self::isEmail('email', $email);
        foreach ($data as $key => $value) {
            self::isRequired($key, $value);
        }
        if (self::hasError() == false) {
            $sql = "UPDATE user SET UserFirstName = '$name' , UserEmail = '$email' WHERE UserId = '$id'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            // self::isLogIn($db);
            return true;
        } else {
            return false;
        }
    }

    public static function updatePassword($db, $oldPassword, $password, $id)
    {
        unset($_SESSION['error']);
        $stmt = $db->query("SELECT * FROM user WHERE UserId = '$id'");
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($oldPassword, $rows['UserPassword'])) {
            self::isPassword('password', $password);
            self::isConfirm("password");
            if (self::hasError() == false) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE user SET UserPassword = '$hash' WHERE UserId = '$id'";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                return true;
            }
        }
        return false;
    }
    public static function login($db, $email, $password)
    {
        $stmt = $db->query("SELECT * FROM user WHERE UserEmail = '$email' ");
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $rows['UserPassword'])) {
            $_SESSION['user'] = $rows['UserId'];
            return new self($rows['UserId'], $rows['UserFirstName'], $rows['UserEmail']);

        } else {
            return false;
        }
    }
    public static function logout()
    {
        session_unset();
        session_destroy();
    }

    public static function isLogIn($db)
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $stmt = $db->query("SELECT * FROM user WHERE UserId = '{$_SESSION['user']}'");
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($rows['UserId'], $rows['UserFirstName'], $rows['UserEmail']);
        } else {
            return false;
        }
    }
}