<?php
session_start();

require_once("../../../Config.php");
require_once("../../../Controller/admin/AdminController.php");
use App\Controller\Admin\AdminController;

$data = AdminController::login($db, $_POST['email'], $_POST['password']);
if ($data == false) {
    header("Location: /book_store/admin/login.php");
} else {
    header("Location: /book_store/admin/dashboard.php");
}
exit;
