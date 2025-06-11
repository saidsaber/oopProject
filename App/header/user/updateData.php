<?php
require_once("../../Config.php");
require_once("../../Controller/UserController.php");
use App\Controller\UserController;
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $data = UserController::updateData($db, $_POST['name'], $_POST['email'], $_SESSION['user']);
    var_dump($data);
    // exit;
    if ($data) {
        header("Location: /book_store/account_details.php");
    }
}else{
    header("Location: /book_store/account.php");
}
    exit;
