<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/BrandController.php");
use App\Controller\Admin\BrandController;
$data = BrandController::CreateBrand($db, $_POST['name'], $_POST['slug']);
if ($data == false) {
    header("Location: /book_store/admin/create-brand.php");
} else {
    header("Location: /book_store/admin/brands.php");
}

exit;
