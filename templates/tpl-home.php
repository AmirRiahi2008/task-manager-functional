<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome 👀</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="page">
    <div class="pageHeader">
      <div class="title">Dashboard</div>
      <div class="userPanel">
        <a href="?logout=1"><i class="fa fa-sign-out"></i></a>
        <span class="username"></span>
        <img src="https://www.gravatar.com/avatar/af67e0eb0f20a1105d2141c90ee948f3" width="40" height="40" />
      </div>
    </div>
    <div class="main">
      <div class="nav">
        <div class="searchbox">
          <div>
            <i class="fa fa-search"></i>
            <input type="search" placeholder="Search" />
          </div>
        </div>
        <div class="menu">
          <div class="title">Folders</div>
          <ul class="folder-list">
            <li class="<?= isset($_GET["folder_id"]) ? "" : "active" ?>">
              <a href="<?= site_uri() ?>">
                <i class="fa fa-folder"></i>
                All
              </a>
            </li>

            <?php foreach ($folders as $folder): ?>
              <li class="<?= isset($_GET["folder_id"]) && $folder->id === $_GET["folder_id"] ? "active" : "" ?>">
                <a href="?folder_id=<?= $folder->id ?>">
                  <i class="fa fa-folder"></i>
                  <?= $folder->name ?>
                </a>
                <a onclick="return confirm('are you sure wanna delete this folder?')"
                  href="?delete_folder=<?= $folder->id ?>">
                  x
                </a>
              </li>
            <?php endforeach ?>

          </ul>
        </div>
        <div>
          <input type="text" id="addFolderInput" style="width: 65%; margin-left: 3%" placeholder="Add New Folder" />
          <button id="addFolderBtn" class="btn clickable">+</button>
        </div>
      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title" style="width: 50%">
            <input type="text" id="taskNameInput" style="width: 100%; margin-left: 3%; line-height: 30px"
              placeholder="Add New Task" />
          </div>
          <div class="functions">
            <div class="button active">Add New Task</div>
            <div class="button">Completed</div>
          </div>
        </div>
        <div class="content">
          <div class="list">
            <div class="title">Today</div>
            <ul>
              <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>

                  <li class="checked" data-task="<?= $task->id ?>">
                    <i class="isDone clickable fa <?= $task->isCompleted ? "fa-check-square-o" : "fa-square-o" ?>"></i>
                    <span><?= $task->body ?></span>
                    <div class="info">
                      <span class="created-at"><?= $task->created_at ?></span>
                      <a href="?delete_task=<?= $task->id ?>"
                        onclick="return confirm('Are You Sure Wanna Delete This Task?')" href="#" class="remove">x</a>
                    </div>
                  </li>
                <?php endforeach ?>
              <?php else: ?>
                <p>No task added</p>
              <?php endif ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script defer src="assets/scripts/eventHandlers.js"></script>
</body>

</html>