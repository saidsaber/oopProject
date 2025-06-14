<?php

namespace App\Controller\Admin;

require_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/book_store/vendor/autoload.php'));
use App\Traits\Validation;
use PDO;
use PDOException;

class BrandController
{
    use Validation;
    private $BrandId;
    private $BrandName;
    private $Slug;

    public function __construct($BrandId, $BrandName, $Slug)
    {
        $this->BrandId = $BrandId;
        $this->BrandName = $BrandName;
        $this->Slug = $Slug;
    }

    public function getBrandId()
    {
        return $this->BrandId;
    }

    public function getBrandName()
    {
        return $this->BrandName;
    }

    public function getSlug()
    {
        return $this->Slug;
    }

    public static function CreateBrand($db, $name, $Slug)
    {
        unset($_SESSION['error']);
        self::isRequired('name', $name);
        self::isRequired('slug', $Slug);
        self::isMin('name', $name);
        self::isMin('slug', $Slug);
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            if (self::hasError() == false) {
                $sql = 'INSERT INTO `brand`(`AdminId`, `BrandName`, `Slug`) VALUES (:id , :name , :slug)';
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':slug' => $Slug,
                    ':id' => $_SESSION['admin']
                ]);
                $id = $db->lastInsertId();
                return new self($id, $name, $Slug);
            }
        }
        return false;
    }

    public static function getBrands($db)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `brand` WHERE AdminId = {$_SESSION['admin']}");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $Brands = [];
            foreach ($rows as $row) {
                $Brands[] = new self($row["BrandId"], $row["BrandName"], $row["Slug"]);
            }
            return $Brands;
        }
        return false;
    }

    public static function getBrand($db , $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `brand` WHERE AdminId = {$_SESSION['admin']} and BrandId = $id");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($row["BrandId"], $row["BrandName"], $row["Slug"]);
        }
        return false;
    }

    public static function UpdateBrand($db ,$id, $name, $Slug){
        unset($_SESSION['error']);

        self::isRequired('name', $name);
        self::isRequired('slug', $Slug);
        self::isMin('slug', $Slug);
        self::isMin('name', $name);

        if (!self::hasError()) {
            $sql = "UPDATE `brand` SET `BrandName` = :name, `Slug` = :slug WHERE BrandId  = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':slug' => $Slug,
                ':id' => $id
            ]);
            return true;
        } else {
            return false;
        }
    }

    public static function deleteBrand($db ,$id){
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->prepare("DELETE FROM `brand` WHERE AdminId = :admin AND BrandId = :brand");
            $stmt->execute([
                ':admin' => $_SESSION['admin'],
                ':brand' => $id
            ]);
        } else {
            return false;
        }
    }
}