<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/SubCategoryController.php");
use App\Controller\Admin\SubCategoryController;
$data = SubCategoryController::createSubCategory($db, $_POST['category'], $_POST['name'] , $_POST['slug']);
if ($data == false) {
    header("Location: /book_store/admin/create-subcategory.php");
} else {
    header("Location: /book_store/admin/subcategory.php");
}

exit;
