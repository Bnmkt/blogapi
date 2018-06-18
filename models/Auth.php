<?php

namespace Blog\Models;

include_once "Model.php";

class Auth extends Model
{
    function createUser($name, $password)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'INSERT INTO users (name, password) VALUES (:name, :password)';
        try {
            $usr = $cx->prepare($sql);
            if($usr){
                $usr->execute([':name' => $name, ':password' => $password]);
                return $cx->lastInsertId();
            }else{
                return false;
            }
        } Catch (PDOException $e) {
            if($e->errorInfo[0] == '23000' && $e->errorInfo[1] == '1062'){
                throw new CustomException("Bla bla already exists");
            }
            else {
                throw $e;
            }
        }
    }

    function connectUser($name, $password)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT id, name, displayedName FROM users WHERE (name = :name OR email = :name) AND password = :password';
        try {
            $usr = $cx->prepare($sql);
            $usr->execute([':name' => $name, ':password' => $password]);
            return $usr->fetch();
        } Catch (PDOException $e) {
            return $e;
        }
    }
}