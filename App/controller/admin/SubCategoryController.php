<?php
namespace App\Controller\Admin;

require_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/book_store/vendor/autoload.php'));
use App\Controller\admin\CategoryController;
use App\Traits\Validation;
use PDO;
use PDOException;

class SubCategoryController
{
    use Validation;
    private $subCateId;
    private $CateId;
    private $subCateName;
    private $subCateSlug;

    public function __construct($subCateId, $CateId, $subCateName, $subCateSlug)
    {
        $this->subCateId = $subCateId;
        $this->CateId = $CateId;
        $this->subCateName = $subCateName;
        $this->subCateSlug = $subCateSlug;
    }

    public function getSubCateId()
    {
        return $this->subCateId;
    }

    public function getCateName($db)
    {
        if ($this->CateId == null) {
            return 'undefin';
        }
        return CategoryController::getCategory($db, $this->CateId)->getCateName();
    }
    public function getSubCateName()
    {
        return $this->subCateName;
    }

    public function getSubCateSlug()
    {
        return $this->subCateSlug;
    }

    public function getCateId()
    {
        return $this->CateId;
    }

    public static function createSubCategory($db, $CateId, $subCateName, $subCateSlug)
    {

        if (!self::hasError()) {
            if (self::hasError() == false) {
                $sql = 'INSERT INTO `subcategory`(`CateId`,`AdminId`, `SCateName`, `Slug`) VALUES (:CateId ,:id , :subCateName , :subCateSlug)';
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':CateId' => $CateId,
                    ':subCateName' => $subCateName,
                    ':subCateSlug' => $subCateSlug,
                    ':id' => $_SESSION['admin']
                ]);
                $id = $db->lastInsertId();
                return new self($id, $CateId, $subCateName, $subCateSlug);
            } else {
                return false;
            }
        }
    }

    public static function getAllSubCategory($db)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `subcategory` WHERE AdminId = {$_SESSION['admin']}");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $subcategory = [];
            foreach ($rows as $row) {
                $subcategory[] = new self($row["SCateId"], $row["CateId"], $row['SCateName'], $row["Slug"]);
            }
            return $subcategory;
        }
        return false;
    }
    public static function getSubCategory($db, $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `subcategory` WHERE AdminId = {$_SESSION['admin']} and SCateId = $id");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($row["SCateId"], $row["CateId"], $row['SCateName'], $row["Slug"]);
        }
        return false;
    }
    public static function updateSubCategory($db, $id, $CateId, $subCateName, $subCateSlug)
    {
        if (isset($_SESSION["admin"]) && !empty($_SESSION["admin"])) {
            $sql = "UPDATE `subcategory` SET `CateId` = :CateId, `SCateName` = :SCateName, `Slug` = :Slug  WHERE `SCateId` = :id";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':CateId' => $CateId,
                ':SCateName' => $subCateName,
                ':Slug' => $subCateSlug,
                ':id' => $id
            ]);
            return true;
        }
        return false;
    }

    public static function deleteSubCategory($db, $CateId)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->prepare("DELETE FROM `subcategory` WHERE AdminId = :admin AND SCateId = :sub");
            $stmt->execute([
                ':admin' => $_SESSION['admin'],
                ':sub' => $CateId
            ]);
        } else {
            return false;
        }
    }


}