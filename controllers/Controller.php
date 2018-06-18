<?php
/**
 * Created by PhpStorm.
 * User: LydiaPC
 * Date: 19/04/18
 * Time: 16:18
 */

namespace Blog\Controllers;

class Controller
{
    function isValid($var)
    {
        if (isset($var)) {
            if ($var) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function uploadFile($files)
    {
        foreach ($files["error"] as $key => $err) {
            $isOk = false;
            switch ($err) {
                case UPLOAD_ERR_OK:
                    $isOk = true;
                    break;
                case UPLOAD_ERR_NO_FILE:
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                default:
            }
            if ($isOk) {
                $tmp_name = $files["tmp_name"][$key];
                $fileName = $files["name"][$key];
                if (strlen($fileName) > 20) {
                    $ext = "." . pathinfo($fileName, PATHINFO_EXTENSION);
                    $fileName = substr($fileName, 0, 12) . $ext;
                }
                $fileName = time() . basename($fileName);
                $ressource = "assets/images/$fileName";
                if (move_uploaded_file($tmp_name, $ressource)) {
                    list($width, $height) = getimagesize($ressource);
                    var_dump($width);
                    var_dump($height);
                    $ratio = $width / $height;
                    $new_width = $width;
                    $new_height = $height;
                    while ($new_width > 400 || $new_height > 400) {
                        if ($new_width > 400) {
                            if ($width > $height) {
                                $new_height = 400 * $ratio;
                            } else {
                                $new_height = 400 / $ratio;
                            }
                            $new_width = 400;
                        }
                        if ($new_height > 400) {
                            if ($width > $height) {
                                $new_width = 400 / $ratio;
                            } else {
                                $new_width = 400 * $ratio;
                            }
                            $new_height = 400;
                        }
                    }
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    $image = imagecreatefromjpeg($ressource);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    if (imagejpeg($image_p, "assets/images/mini-$fileName", 100)) {
                        return "assets/images/$name";
                    }
                } else {
                    return false;
                }
            }
        }
    }

    function authCheck()
    {
        if (!isset($_POST["userid"])) {
            header("Location: api.php");
            exit;
        }
        return true;
    }
}