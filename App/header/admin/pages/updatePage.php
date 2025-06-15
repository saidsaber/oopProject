<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/pagesController.php");
use App\Controller\Admin\pagesController;
$data = pagesController::updatePage($db, $_POST['name'], $_POST['slug'] , $_POST['content'] , $_POST['id']);
if ($data == false) {
    header("Location: /book_store/admin/create-page.php?id={$_POST['id']}");
} else {
    header("Location: /book_store/admin/pages.php");
}

exit;
