<?php

namespace Blog\Controllers;

use Blog\Models\Auth;

class AuthController extends Controller
{
    private $authModel = null;

    function __construct()
    {
        $this->authModel = new Auth;
    }

    function signin()
    {
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
        unset($_SESSION["error"]);
        return [
            'view' => 'authSignin.php',
            'title' => "S'inscrire",
            'data' => [
                "error" => $error
            ]
        ];
    }

    function login()
    {
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
        unset($_SESSION["error"]);
        return [
            'view' => 'authLogin.php',
            'title' => 'Se connecter',
            'data' => [
                "error" => $error
            ]
        ];
    }

    function create()
    {
        if (!$this->isValid($_POST["name"]) || !$this->isValid($_POST["pass"])) {
            $_SESSION["error"]["data"] = "";
            $_SESSION["error"]["data"] .= $this->isValid($_POST["pass"])?"":"mot de passe manquant ";
            $_SESSION["error"]["data"] .= $this->isValid($_POST["name"])?"":"pseudonyme manquant ";
            $_SESSION["error"]["msg"] = "Un champ est manquant";
            $_SESSION["error"]["code"] = "1";
            header("Location: api.php?a=signin&r=auth");
            exit();
        }
        if (isset($_SESSION["user"])) unset($_SESSION["user"]);
        $name = $_POST["name"];
        $pass = hash("sha256", $_POST["pass"], false);
        $pass2 = hash("sha256", $_POST["pass2"], false);
        $connect = $this->authModel->connectUser($name, $pass);
        if ($connect && $connect !== false) {
            $_SESSION["error"]["data"] = $connect;
            $_SESSION["error"]["code"] = "0";
            header("Location: api.php?a=signin&r=auth");
//        echo "Vous avez déjà un compte :o";
            exit();
        }
        if (!$this->isValid($_POST["pass2"])) {
            $_SESSION["error"]["msg"] = "Un champ est manquant";
            $_SESSION["error"]["code"] = "4";
            header("Location: api.php?a=signin&r=auth");
            exit();
        }
        if ($pass !== $pass2) {
            $_SESSION["error"]["msg"] = "Les mots de passes ne sont pas identiques";
            $_SESSION["error"]["code"] = "2";
            header("Location: api.php?a=signin&r=auth");
        }
        $create = $this->authModel->createUser($name, $pass);
        if (!$create || $create === false) {
            $_SESSION["error"]["msg"] = "Une personne existe déjà avec ce nom d'utilisateur";
            $_SESSION["error"]["code"] = "3";
            header("Location: api.php?a=signin&r=auth");
            exit();
        }
        $this->connect();
        header("Location: api.php?a=signin&r=auth");
        exit();
    }

    function connect()
    {
        if (!$this->isValid($_POST["name"]) || !$this->isValid($_POST["pass"])) {
            $_SESSION["error"]["msg"] = "Un champ est manquant";
            $_SESSION["error"]["code"] = "1";
            header("Location: api.php?a=login&r=auth");
            exit();
        }
        if (isset($_SESSION["user"])) unset($_SESSION["user"]);
        $name = $_POST["name"];
        $pass = hash("sha256", $_POST["pass"], false);
        $connect = $this->authModel->connectUser($name, $pass);
        if (!$connect || $connect === false) {
            $_SESSION["error"]["msg"] = "Nous n'avons pas pû vous connecter";
            $_SESSION["error"]["code"] = "2";
            header("Location: api.php?a=login&r=auth");
            exit();
        }
        $_SESSION["error"]["data"] = $connect;
        $_SESSION["error"]["code"] = "0";
        header("Location: api.php?a=login&r=auth");
        exit();
    }

    function disconnect()
    {
        session_destroy();
        header('Location: api.php');
        exit();
    }
}