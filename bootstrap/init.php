<?php
define("BASE_PATH", __DIR__ . "/../");
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "helpers/helper.php";
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
try {
    $pdo = new PDO("mysql:host={$_ENV['HOST']};dbname={$_ENV['DB']}", $_ENV["USER"], $_ENV["PASSWORD"]);
} catch (PDOException $e) {
    echo $e->getMessage();
}
include BASE_PATH . "validations/valid-auth.php";
include BASE_PATH . "validations/valid-todo.php";