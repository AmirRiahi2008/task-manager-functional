<?php
include "./bootstrap/init.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $action = $_GET["action"];
    $params = $_POST;
    if($action==="register"){
        $res = register($params);
        if(!$res) echo "Error Registering";
        redirect();
    }else if($action ==="login"){
        $res = login($params["username"] , $params["password"]);
        if(!$res) die("username or password is incorrect") ;
        redirect();
    }
}
include BASE_PATH  . "templates/tpl-auth.php";
