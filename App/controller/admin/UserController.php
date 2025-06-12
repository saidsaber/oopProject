<?php

namespace App\Controller\Admin;

require_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/book_store/vendor/autoload.php'));
use App\Traits\Validation;
use PDO;
use PDOException;
class UserController
{
    use Validation;
    private $adminId;
    private $adminName;
    private $adminEmail;
    private $adminPhone;
    private $adminGender;

    public function __construct($adminId, $adminName, $adminEmail, $adminPhone, $adminGender)
    {
        $this->adminId = $adminId;
        $this->adminName = $adminName;
        $this->adminEmail = $adminEmail;
        $this->adminPhone = $adminPhone;
        $this->adminGender = $adminGender;
    }

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function getAdminName()
    {
        return $this->adminName;
    }

    public function getAdminEmail()
    {
        return $this->adminEmail;
    }

    public function getAdminPhone()
    {
        return $this->adminPhone;
    }

    public function getAdminGender()
    {
        return $this->adminGender;
    }

    public static function createUser($db, $name, $email, $phone, $gender, $password)
    {
        unset($_SESSION['error']);
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'password' => $password
        ];
        self::isMin('name', $name);
        self::isPhone('phone', $phone);
        self::isPassword('password', $password);
        self::isEmail('email', $email);
        self::gender('gender', $gender);
        foreach ($data as $key => $value) {
            self::isRequired($key, $value);
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if (self::hasError() == false) {

            $sql = 'INSERT INTO `adminuser`( `AdminName`, `AdminEmail`, `AdminPhone`, `Gender`, `Active`, `Password`) VALUES (:name , :email , :phone , :gender , :active , :hash)';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':gender' => $gender,
                ':active' => 1,
                ':hash' => $hash
            ]);
            $id = $db->lastInsertId();
            $_SESSION['admin'] = $id;
            return new self($id, $name, $email, $phone, $gender);
        } else {
            return false;
        }
    }

    public static function login($db, $email, $password)
    {
        $stmt = $db->query("SELECT * FROM adminuser WHERE AdminEmail = '$email' ");
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $rows['Password'])) {
            $_SESSION['admin'] = $rows['AdminId'];
            return new self($rows['AdminId'], $rows['AdminName'], $rows['AdminEmail'], $rows['AdminPhone'], $rows['Gender']);
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
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM adminuser WHERE AdminId = '{$_SESSION['admin']}'");
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($rows['AdminId'], $rows['AdminName'], $rows['AdminEmail'], $rows['AdminPhone'], $rows['Gender']);
        } else {
            return false;
        }
    }
}
