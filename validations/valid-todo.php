<?php
function addFolder($folderName)
{
    global $pdo;
    $sql = "INSERT INTO `folders` (name, user_id) VALUES(:name, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":name" => $folderName,
        ":user_id" => getCurUserId()
    ]);
    return $pdo->lastInsertId();
    
}
function addTodo($body, $folderId)
{
    global $pdo;
    $sql = "INSERT INTO tasks (body , user_id , folder_id) VALUES(:body , :user_id , :folder_id)";
    $stmt = $pdo->prepare($sql);
    $userId = getCurUserId();
    $stmt->execute([":body" => $body, ":user_id" => $userId, ":folder_id" => $folderId]);
    return $pdo->lastInsertId();
}

function deleteFolder($id)
{
    global $pdo;
    $sql = "DELETE FROM `folders` WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->rowCount();
}

function deleteTask($id)
{
    global $pdo;
    $sql = "DELETE FROM `tasks` WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->rowCount();
}

function doneSwitch($taskId)
{
    global $pdo;
    $sql = "UPDATE tasks SET isCompleted = 1 - isCompleted WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $taskId]);
    return $stmt->rowCount();
}

function getFolders()
{
    global $pdo;
    $curUser = getCurUserId();
    $sql = "SELECT * FROM `folders` WHERE user_id=$curUser";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function getTasks()
{
    global $pdo;
    $curUser = getCurUserId();
    $condition = "";
    if (isset($_GET["folder_id"]) && is_numeric($_GET["folder_id"])) {
        $condition = " AND folder_id={$_GET['folder_id']}";
    }
    $sql = "SELECT * FROM `tasks` WHERE user_id=$curUser $condition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}