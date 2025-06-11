<?php
namespace App\Controller;
require_once("../../vendor/autoload.php");
use App\Traits\Validation;

class Test{
    use Validation;
    public static function index(){
        return self::isEmail('email' , 'saidsaber@gmail.com');
        // return "my name is said";
    }
}

echo (new Test)->index();