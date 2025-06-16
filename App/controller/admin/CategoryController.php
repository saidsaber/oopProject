<?php
namespace App\Controller\Admin;

require_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/book_store/vendor/autoload.php'));
use App\Traits\Validation;
use PDO;
use PDOException;

class CategoryController
{
    use Validation;

    private $CateId;
    private $CateName;
    private $CateSlug;

    public function __construct($CateId, $CateName, $CateSlug)
    {
        $this->CateId = $CateId;
        $this->CateName = $CateName;
        $this->CateSlug = $CateSlug;
    }
    public function getCateId()
    {
        return $this->CateId;
    }

    public function getCateName()
    {
        return $this->CateName;
    }

    public function getCateSlug()
    {
        return $this->CateSlug;
    }

    public static function getAllCategories($db)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `category` WHERE AdminId = {$_SESSION['admin']}");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $categories = [];
            foreach ($rows as $row) {
                $categories[] = new self($row["CateId"], $row["CateName"], $row["Slug"]);
            }
            if(count($categories) > 0) {
                return $categories;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function getCategory($db, $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `category` WHERE AdminId = {$_SESSION['admin']} and CateId = $id");
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($rows["CateId"], $rows["CateName"], $rows["Slug"]);
        } else {
            return false;
        }
    }

    public static function deleteCategory($db, $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->prepare("DELETE FROM `category` WHERE AdminId = :admin AND CateId = :cate");
            $stmt->execute([
                ':admin' => $_SESSION['admin'],
                ':cate' => $id
            ]);
        } else {
            return false;
        }
    }
    public static function createCategory($db, $name, $slug)
    {
        unset($_SESSION['error']);
        self::isRequired('name', $name);
        self::isRequired('slug', $slug);
        self::isMin('slug', $slug);
        self::isMin('name', $name);
        if (self::hasError() == false) {
            $sql = 'INSERT INTO `category`( `CateName`, `Slug` , `AdminId`) VALUES (:name , :slug , :id)';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':slug' => $slug,
                ':id' => $_SESSION['admin']
            ]);
            $id = $db->lastInsertId();
            return new self($id, $name, $slug);
        } else {
            return false;
        }
    }

    public static function updateCategory($db, $id, $name, $slug)
    {
        unset($_SESSION['error']);

        self::isRequired('name', $name);
        self::isRequired('slug', $slug);
        self::isMin('slug', $slug);
        self::isMin('name', $name);

        if (!self::hasError()) {
            $sql = "UPDATE `category` SET `CateName` = :name, `Slug` = :slug WHERE CateId = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':slug' => $slug,
                ':id' => $id
            ]);
            return true;
        } else {
            return false;
        }

    }
}