<?php
namespace App\Controller\Admin;

require_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/book_store/vendor/autoload.php'));
use App\Traits\Validation;
use App\Traits\Images;
use PDO;
use PDOException;

class ProductController
{
    use Validation;
    use Images;
    private $id;
    private $name;
    private $title;
    private $lang;
    private $qty;
    private $description;
    private $price;
    private $priceAfterDiscount;
    private $status;
    private $category;
    private $subcategory;
    private $brand;

    private $image;
    public function __construct($id, $image, $title, $lang, $qty, $description, $priceAfterDiscount, $price, $status, $category, $subcategory, $brand)
    {
        $this->id = $id;
        $this->title = $title;
        $this->lang = $lang;
        $this->qty = $qty;
        $this->description = $description;
        $this->price = $price;
        $this->priceAfterDiscount = $priceAfterDiscount;
        $this->status = $status;
        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->brand = $brand;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function getPriceAfterDiscount()
    {
        return $this->priceAfterDiscount;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getSubcategory()
    {
        return $this->subcategory;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getImage()
    {
        return $this->image;
    }

    public static function createProduct($db, $image, $title, $lang, $qty, $description, $priceAfterDiscount, $price, $status, $category, $subcategory, $brand)
    {
        unset($_SESSION['error']);
        $data = [
            'title' => $title,
            'lang' => $lang,
            'qty' => $qty,
            'description' => $description,
            'price' => $price,
            'priceAfterDiscount' => $priceAfterDiscount,
            'status' => $status,
            'category' => $category,
            'subcategory' => $subcategory,
            'brand' => $brand
        ];

        self::isMin('title', $title);
        self::isMin('description', $description);
        foreach ($data as $key => $value) {
            self::isRequired($key, $value);
        }
        $defaultImage = (self::uploadImage($image));
        if (!self::hasError()) {
            $sql = 'INSERT INTO `product`(`SCateId`, `CateId`, `BrandId`, `AdminId`, `ProductTitle`, `ProductDescription`, `ProductPrice`, `PriceAfterDiscount`, `ProductQty`, `lang`, `Image`, `status`) VALUES
                (:SCateId , :CateId , :BrandId , :AdminId , :ProductTitle , :ProductDescription , :ProductPrice , :PriceAfterDiscount , :ProductQty , :lang , :Image , :status  )
            ';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':SCateId' => $subcategory,
                ':CateId' => $category,
                ':BrandId' => $brand,
                ':AdminId' => $_SESSION['admin'],
                ':ProductTitle' => $title,
                ':ProductDescription' => $description,
                ':ProductPrice' => $price,
                ':PriceAfterDiscount' => $priceAfterDiscount,
                ':ProductQty' => $qty,
                ':lang' => $lang,
                ':Image' => $defaultImage,
                ':status' => $status
            ]);
            $id = $db->lastInsertId();

            return new self($id, $defaultImage, $title, $lang, $qty, $description, $priceAfterDiscount, $price, $status, $category, $subcategory, $brand);
        }
        return false;
    }

    public static function getAllProduct($db)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `product` WHERE AdminId = {$_SESSION['admin']}");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $product = [];
            foreach ($rows as $row) {
                $product[] = new self($row["ProductId"], $row['Image'], $row["ProductTitle"], $row["lang"], $row['ProductQty'], $row['ProductDescription'], $row['PriceAfterDiscount'], $row['ProductPrice'], $row['status'], $row['CateId'], $row['SCateId'], $row['BrandId']);
            }
            return $product;
        }
        return false;
    }

    public static function getProduct($db, $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->query("SELECT * FROM `product` WHERE AdminId = {$_SESSION['admin']} and ProductId = $id");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($row["ProductId"], $row['Image'], $row["ProductTitle"], $row["lang"], $row['ProductQty'], $row['ProductDescription'], $row['PriceAfterDiscount'], $row['ProductPrice'], $row['status'], $row['CateId'], $row['SCateId'], $row['BrandId']);
        }
        return false;
    }
    public static function deleteProduct($db, $id)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $stmt = $db->prepare("DELETE FROM `product` WHERE AdminId = :admin AND ProductId  = :product");
            $stmt->execute([
                ':admin' => $_SESSION['admin'],
                ':product' => $id
            ]);
        } else {
            return false;
        }
    }
    public static function updateProduct($db, $id, $image, $title, $lang, $qty, $description, $priceAfterDiscount, $price, $status, $category, $subcategory, $brand)
    {
        unset($_SESSION['error']);

        $data = [
            'title' => $title,
            'lang' => $lang,
            'qty' => $qty,
            'description' => $description,
            'price' => $price,
            'priceAfterDiscount' => $priceAfterDiscount,
            'status' => $status,
            'category' => $category,
            'subcategory' => $subcategory,
            'brand' => $brand
        ];

        self::isMin('title', $title);
        self::isMin('description', $description);

        foreach ($data as $key => $value) {
            self::isRequired($key, $value);
        }

        $defaultImage = self::uploadImage($image); // سترجع false إذا لم يتم رفع صورة جديدة

        if (!self::hasError()) {
            $sql = 'UPDATE `product` SET 
                    `SCateId` = :SCateId,
                    `CateId` = :CateId,
                    `BrandId` = :BrandId,
                    `ProductTitle` = :ProductTitle,
                    `ProductDescription` = :ProductDescription,
                    `ProductPrice` = :ProductPrice,
                    `PriceAfterDiscount` = :PriceAfterDiscount,
                    `ProductQty` = :ProductQty,
                    `lang` = :lang,
                    `status` = :status';

            if ($defaultImage) {
                $sql .= ', `Image` = :Image';
            }

            $sql .= ' WHERE ProductId = :id';

            $stmt = $db->prepare($sql);

            $params = [
                ':SCateId' => $subcategory,
                ':CateId' => $category,
                ':BrandId' => $brand,
                ':ProductTitle' => $title,
                ':ProductDescription' => $description,
                ':ProductPrice' => $price,
                ':PriceAfterDiscount' => $priceAfterDiscount,
                ':ProductQty' => $qty,
                ':lang' => $lang,
                ':status' => $status,
                ':id' => $id
            ];

            if ($defaultImage) {
                $params[':Image'] = $defaultImage;
            }

            $stmt->execute($params);

            return new self($id, $defaultImage, $title, $lang, $qty, $description, $priceAfterDiscount, $price, $status, $category, $subcategory, $brand);
        }

        return false;
    }

}