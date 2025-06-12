<?php
require_once("../../../Config.php");
require_once("../../../Controller/UserController.php");
use App\Controller\Admin\UserController;
$data = UserController::createUser($db, $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['gender'], $_POST['password']);
if ($data == false) {
    header("Location: /book_store/admin/create-user.php");
} else {
    header("Location: /book_store/admin/dashboard.php");
}

exit;
