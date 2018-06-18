<?php

namespace Blog\Models;

include_once 'Model.php';

class Post extends Model
{

    function getPosts()
    {
        $cx = $this->getConnectionToDb();
        $sql = '
                SELECT u.name AS authName, u.displayedName AS authDispName, 
                p.id AS postId, p.title AS postTitle, p.body AS postContent, p.featured AS isPostFeatured, p.date AS postDate, p.responseTo, 
                if(ur.displayedName, ur.displayedName, ur.name) AS respName
                FROM posts AS p 
                JOIN posts r ON (p.responseTo = r.id OR p.responseTo = NULL) 
                JOIN users ur ON r.user_id = ur.id
                JOIN users u ON p.user_id = u.id 
                ORDER BY postDate DESC ';
        $pst = $cx->query($sql);
        return $pst->fetchAll();
    }

    function getFeaturedPosts()
    {
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT u.name AS username, p.id, p.title, p.body, p.featured,p.thumb, p.date FROM posts AS p JOIN users u WHERE user_id = u.id AND p.featured = 1 ORDER BY date DESC LIMIT 3';
        $pst = $cx->query($sql);
        return $pst->fetchAll();
    }

    function getPost($id)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT u.name AS authName, u.displayedName AS authDispName, 
                p.id AS postId, p.title AS postTitle, p.body AS postContent, p.featured AS isPostFeatured, p.date AS postDate, p.responseTo, 
                if(ur.displayedName, ur.displayedName, ur.name) AS respName
                FROM posts AS p 
                JOIN posts r ON (p.responseTo = r.id OR p.responseTo = NULL) 
                JOIN users ur ON r.user_id = ur.id
                JOIN users u ON p.user_id = u.id 
                WHERE p.id = :id ORDER BY postDate DESC
               ';
        $pst = $cx->prepare($sql);
        $pst->execute([':id' => $id]);
        return $pst->fetch();
    }

    function getResponseOfPost($id)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT u.name AS authName, u.displayedName AS authDispName, p.id AS postId, p.title AS postTitle, p.body AS postContent, p.featured AS isPostFeatured, p.date AS postDate FROM posts AS p JOIN users u ON user_id = u.id WHERE p.responseTo = :id ORDER BY postId DESC';
        $pst = $cx->prepare($sql);
        $pst->execute([':id' => $id]);
        return $pst->fetchAll();
    }


    function createPost($title, $body, $user_id, $resp)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'INSERT INTO posts (`title`, `body`, `date`, `user_id`, `responseTo`) VALUES (:title, :body, NOW(), :uid, :resp)';
        $pst = $cx->prepare($sql);
        $pst->execute([':title' => $title, ':body' => $body, ':uid' => $user_id, ':resp' => $resp]);
        return $cx->lastInsertId();
    }

    function updatePost($id, $title, $body)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
        $pst = $cx->prepare($sql);
        $pst->execute([':title' => $title, ':body' => $body, ':id' => $id]);
        return true;
    }

    function deletePost($id)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'DELETE FROM posts WHERE id=:id';
        $pst = $cx->prepare($sql);
        $pst->execute([':id' => $id]);
        return true;
    }
}