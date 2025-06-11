<?php
require_once("../../Config.php");
require_once("../../Controller/UserController.php");
use App\Controller\UserController;
$data = UserController::login($db , $_POST['loginemail'] , $_POST['password']);
if ($data) {
    header("Location: /book_store/index.php");
} else {
    header("Location: /book_store/account.php");
}
exit;
