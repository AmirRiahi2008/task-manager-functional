<?php
include "bootstrap/init.php";
if (!isLogged()) {
    redirect("auth.php");
}
if (isset($_GET["logout"])) {
    logout();
}
if (isset($_GET["delete_folder"]) && is_numeric($_GET["delete_folder"])) {
    deleteFolder($_GET["delete_folder"]);
}

if (isset($_GET["delete_task"]) && is_numeric($_GET["delete_task"])) {
    deleteTask($_GET["delete_task"]);
}
$folders = getFolders();
$tasks = getTasks();
include BASE_PATH . "templates/tpl-home.php";
