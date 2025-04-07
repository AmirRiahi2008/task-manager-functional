<?php
session_start();
function register($userData)
{
    global $pdo;
    $hashedPassword = password_hash($userData["password"], PASSWORD_BCRYPT);
    $sql = "INSERT INTO `users` (username , password , email) VALUES(:username , :password , :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":username" => $userData["username"], ":password" => $hashedPassword, ":email" => $userData["email"]]);
    return $pdo->lastInsertId();
}

function login($username, $password)
{
    global $pdo;
    //get user by email
    $sql = "SELECT * FROM `users` WHERE username=:username LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":username" => $username]);
    $record = $stmt->fetch(PDO::FETCH_OBJ);
    if ($record&&password_verify($password, $record->password)) {
        $_SESSION["info"] = $record;
        return true;
    }else{
        return false;

    }
    // return false;
}

function logout()
{
    unset($_SESSION["info"]);
}
function getCurUser()
{
    return $_SESSION["info"];
}

function getCurUserId()
{
    return $_SESSION["info"]->id;
}

function isLogged()
{
    return isset($_SESSION["info"]);
}