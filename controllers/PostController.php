<?php

namespace Blog\Controllers;

use Blog\Models\Post;

class PostController extends Controller
{
    private $postModel = null;

    function __construct()
    {
        $this->postModel = new Post;
    }

    function index()
    {
        $posts = $this->postModel->getPosts();
        return [
            "heading" => "featured.php",
            'view' => 'postIndex.php',
            'title' => 'Toutes les publications',
            'data' => ['pageTitle' => 'liste des publications',
                'posts' => $posts,
            ]
        ];
    }

    function create()
    {
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
        unset($_SESSION["error"]);
        return [
            'view' => 'postCreate.php',
            'title' => 'Créer un article',
            'data' => [
                'error' => $error
            ]
        ];
    }

    function store()
    {
        $this->authCheck();
        if (!$this->isValid($_POST["title"]) || !$this->isValid($_POST["body"])) {
            $_SESSION["error"]["msg"] = "Il manque un champ...";
            $_SESSION["error"]["code"] = "1";
            header("location: api.php?a=create&r=post");
            die();
        };
        echo "j'suis arrive jusque la";
        $title = $_POST["title"];
        $body = $_POST["body"];
        $resp = $_POST["responseTo"]? $_POST["responseTo"] : 0;
        $id = $this->postModel->createPost($title, $body, $_POST["userid"], $resp);
        $_SESSION["error"]["data"]["id"] = $id;
        $_SESSION["error"]["code"] = "0";
        header("location: api.php?a=create&r=post&id=$id");
    }

    function show()
    {
        if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) return false;
        $id = $_GET['id'];
        $post = $this->postModel->getPost($id);
        $resp = $this->postModel->getResponseOfPost($id);
        return [
            'view' => 'postShow.php',
            'title' => 'Lire un article',
            'data' => [
                'post' => $post,
                'response' => $resp
            ]
        ];
    }

    function edit()
    {
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
        unset($_SESSION["error"]);
        $this->authCheck();
        if (!isset($_GET["id"])) {
            header("Location: api.php");
            exit();
        }
        $id = $_GET['id'];
        $post = $this->postModel->getPost($id);
        return [
            'view' => 'postEdit.php',
            'title' => 'Modifier un article',
            'data' => [
                'post' => $post,
                'error' => $error
            ]
        ];
    }

    function update()
    {
        $this->authCheck();
        if (!$this->isValid($_POST["title"]) || !$this->isValid($_POST["body"]) || !$this->isValid($_POST["id"])) {
            header("Location: api.php");
            die();
        };
        $id = $_POST["id"];
        $title = $_POST["title"];
        $body = $_POST["body"];
        $this->postModel->updatePost($id, $title, $body);
        header("Location: api.php?a=show&r=post&id=$id");
    }

    function destroy()
    {
        $this->authCheck();
        if (!isset($_GET["id"])) {
            header("Location: api.php");
            die();
        };
        $id = $_GET["id"];
        $this->postModel->deletePost($id);
        header("Location: api.php");
    }

}
