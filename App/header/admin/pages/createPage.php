<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/pagesController.php");
use App\Controller\Admin\pagesController;
$data = pagesController::createPage($db, $_POST['name'], $_POST['slug'] , $_POST['content']);
if ($data == false) {
    header("Location: /book_store/admin/create-page.php");
} else {
    header("Location: /book_store/admin/pages.php");
}

exit;
