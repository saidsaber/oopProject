<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/SubCategoryController.php");
use App\Controller\Admin\SubCategoryController;
$data = SubCategoryController::updateSubCategory($db, $_POST['id'],$_POST['category'], $_POST['name'] , $_POST['slug']);
if ($data == false) {
    header("Location: /book_store/admin/create-subcategory.php?id={$_POST['id']}");
} else {
    header("Location: /book_store/admin/subcategory.php");
}

exit;
