<?php
namespace App\Controller\Admin;

require_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/book_store/vendor/autoload.php'));
use App\Traits\Validation;
use PDO;
use PDOException;

class PagesController
{
    use Validation;
    private $id;
    private $name;
    private $slug;
    private $content;

    public function __construct($id, $name, $slug, $content)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->content = $content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getContent()
    {
        return $this->content;
    }
    public static function createPage($db, $name, $slug, $content)
    {
        unset($_SESSION['error']);
        $data = [
            'name' => $name,
            'slug' => $slug,
            'content' => $content
        ];
        self::isMin('name', $name);
        self::isMin('slug', $slug);
        foreach ($data as $key => $value) {
            self::isRequired($key, $value);
        }

        if (!self::hasError()) {
            $sql = 'INSERT INTO `page`( `AdminId`, `PageName`, `Content`, `Slug`) VALUES  (:adminId , :name , :content , :slug)';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':adminId' => $_SESSION['admin'],
                'name' => $name,
                ':slug' => $slug,
                ':content' => $content
            ]);
            $id = $db->lastInsertId();
            return new self($id, $name, $slug, $content);
        } else {
            return false;

        }
    }

    public static function getPages($db)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `page` WHERE AdminId = {$_SESSION['admin']}");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pages = [];
            foreach ($rows as $row) {
                $pages[] = new self($row["PageId"], $row["PageName"], $row["Slug"], $row['Content']);
            }
            return $pages;
        } else {
            return false;
        }
    }

    public static function deletePage($db, $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->prepare("DELETE FROM `page` WHERE AdminId = :admin AND PageId = :page");
            $stmt->execute([
                ':admin' => $_SESSION['admin'],
                ':page' => $id
            ]);
        } else {
            return false;
        }
    }
    public static function getPage($db, $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `page` WHERE AdminId = {$_SESSION['admin']} and PageId = $id");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($row["PageId"], $row["PageName"], $row["Slug"] , $row['Content']);
        }
        return false;
    }

    public static function updatePage($db, $name , $slug , $content , $id){
        unset($_SESSION['error']);
        $data = [
            'name' => $name,
            'slug' => $slug,
            'content' => $content
        ];
        self::isMin('name', $name);
        self::isMin('slug', $slug);
        foreach ($data as $key => $value) {
            self::isRequired($key, $value);
        }

        if(!self::hasError()){
            if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
                $sql = "UPDATE `page` SET `PageName` = :name, `Slug` = :slug , `Content` = :Content WHERE PageId = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':id' => $id,
                    ':name'=> $name,
                    ':slug'=> $slug,
                    ':Content'=> $content
                ]);
                return true;
            }
        }
        return false;
    }
}