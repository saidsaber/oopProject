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
            return $categories;
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
        self::isMin('slug', $slug);
        if (self::hasError() == false) {
            $sql = 'INSERT INTO `category`( `CateName`, `Slug` , `AdminId`) VALUES (:name , :slug , :id)';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':slug' => $slug,
                ':id'=> $_SESSION['admin']
            ]);
            $id = $db->lastInsertId();
            return new self($id, $name, $slug);
        } else {
            return false;
        }
    }
}