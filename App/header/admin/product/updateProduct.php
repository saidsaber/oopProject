<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/ProductController.php");
use App\Controller\Admin\ProductController;
$data = ProductController::updateProduct($db, $_POST['id'],$_FILES['image'], $_POST['title'], $_POST['lang'], $_POST['qty'], $_POST['description'], $_POST['compare_price'], $_POST['price'], $_POST['status'], $_POST['category'], $_POST['sub_category'], $_POST['brand']);
echo "<pre>";
if (!$data) {
    header("Location: /book_store/admin/create-product.php");
} else {
    header("Location: /book_store/admin/products.php");
}
exit;
// $db, $name, $title, $lang, $qty, $description, $priceAfterDiscount, $price, $status, $category, $subcategory, $brand