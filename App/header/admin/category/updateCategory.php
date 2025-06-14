<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/CategoryController.php");
use App\Controller\Admin\CategoryController;
$data = CategoryController::updateCategory($db,$_POST['id'], $_POST['name'], $_POST['slug']);
if (!$data) {
    header("Location: /book_store/admin/create-category.php");
} else {
    header("Location: /book_store/admin/categories.php");
}

exit;
