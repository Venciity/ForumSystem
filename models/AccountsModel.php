<?php

class AccountsModel extends BaseModel{
    public function register($username, $password){
        $statement = self::$db->prepare("SELECT COUNT(Id) FROM Users WHERE Username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if($result['COUNT(Id)']){
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $registerStatement = self::$db->prepare("INSERT INTO Users (Username, pass_hash) VALUES (?, ?)");
        $registerStatement->bind_param("ss", $username, $hashedPassword);
        $registerStatement->execute();

        return true;
    }

    public function login($username, $password){
        $statement = self::$db->prepare("SELECT Id, username, pass_hash FROM Users WHERE Username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if(password_verify($password, $result['pass_hash'])){
            return true;
        }

        return false;
    }
}