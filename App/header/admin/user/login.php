<?php
require_once("../../../Config.php");
require_once("../../../Controller/UserController.php");
use App\Controller\Admin\UserController;

$data = UserController::login($db, $_POST['email'], $_POST['password']);

if ($data == false) {
    header("Location: /book_store/admin/login.php");
} else {
    header("Location: /book_store/admin/dashboard.php");
}
exit;
