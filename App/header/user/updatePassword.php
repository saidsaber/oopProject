<?php
require_once("../../Config.php");
require_once("../../Controller/UserController.php");
use App\Controller\UserController;
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $data = UserController::updatePassword($db, $_POST['oldPassword'], $_POST['password'], $_SESSION['user']);
    if ($data) {
        header("Location: /book_store/account_details.php");
    }
} else {
    header("Location: /book_store/account.php");
}
exit;
