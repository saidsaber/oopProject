<?php
namespace App\Traits;

trait Images
{
    public static function uploadImage($file)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/book_store/assets/images/';
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $maxSize = 5 * 1024 * 1024;
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if ($file['size'] > $maxSize) {
            return false;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExtensions)) {
            return false;
        }

        $newFileName = uniqid('img_', true) . '.' . $ext;

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $destination = $path . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $newFileName;
        }

        return false;
    }
}