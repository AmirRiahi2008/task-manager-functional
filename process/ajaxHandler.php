<?php
include "../bootstrap/init.php";
if (empty($_POST["action"]) || is_null($_POST["action"])) {
    echo json_encode(["status" => 0, "error" => "action is empty"]);
    exit();

}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];
    switch ($action) {
        case "addFolder":
            $folderName = $_POST["folderName"];
            if (empty($folderName) || strlen($folderName) < 4 || $folderName === null) {
                echo json_encode(["status" => 0, "error" => "Folder Name should be bigger than 4 letters"]);
                exit();
            }
            $result = addFolder($folderName);
            if (!$result) {
                echo json_encode(["status" => 0, "error" => "Erorr during adding folder"]);
                exit();

            }
            echo json_encode(["status" => 1, "id" => $result]);

            break;
        case "addTask":
            $task = $_POST["taskName"];
            $folderId = $_POST["folderId"];
           if (empty($folderId) || $folderId === null ||!$folderId){
            echo "Select Folder";
            exit();
            }
            if(empty($task) || strlen($task) < 4 || $task === null){
                echo "Task Name Should Be Bigger Than 4 letters";
                exit();
            }
            $result = addTodo($task , $folderId);
            if(!$result){
                echo "Error During Adding Task";
                exit();
            }
            echo "1";
            break;
        case "taskState" :
            $taskId = $_POST["taskId"];
            if($taskId === null || empty($taskId)){
                echo "Task ID is invalid";
                exit();
            }
            $result = doneSwitch($taskId);
echo $result;
            break;
        default:
            echo json_encode(["status" => 0, "error" => "Invalid action"]);
    }
} else {
    echo json_encode(["status" => 0, "error" => "Request Method is incorrect"]);
}
