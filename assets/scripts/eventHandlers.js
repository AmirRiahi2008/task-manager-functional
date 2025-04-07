"use strcit";
window.addEventListener("DOMContentLoaded", (e) => {
  const addFolderInput = document.getElementById("addFolderInput");
  const addFolderBtn = document.getElementById("addFolderBtn");
  const taskNameInput = document.getElementById("taskNameInput");
  const isDoneBtn = document.querySelectorAll(".isDone");
  addFolderBtn.addEventListener("click", (e) => {
    const folderName = addFolderInput.value.trim();
    fetch("process/ajaxHandler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `action=addFolder&folderName=${encodeURIComponent(folderName)}`,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === 1) {
          const item = document.createElement("li");
          const container = document.querySelector(".folder-list");
          const link = document.createElement("a");
          const removeLink = document.createElement("a");
          link.href = `?folder_id=${data.id}`;
          link.innerHTML = `<i class="fa fa-folder"></i>${folderName}`;
          encodeURIComponent;
          removeLink.onclick = (e) => {
            if (!confirm("Are You Sure Wanna Delete This Folder ?")) {
              e.preventDefault();
            }
          };
          removeLink.href = `?delete_folder=${data.id}`;
          removeLink.innerHTML = " x";
          item.appendChild(link);
          item.appendChild(removeLink);
          container.appendChild(item);
        } else {
          alert(data.error);
        }
      })
      .catch((err) => {
        alert(err);
      });
  });
  taskNameInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      const folderId =
        new URLSearchParams(window.location.search).get("folder_id") ?? null;
      if (!folderId) {
        alert("Please select a folder first!");
        return;
      }
      const input = taskNameInput.value.trim();
      fetch("process/ajaxHandler.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `action=addTask&folderId=${encodeURIComponent(
          folderId
        )}&taskName=${encodeURIComponent(input)}`,
      })
        .then((res) => res.text())
        .then((data) => {
          if (data.trim() == "1") {
            window.location.reload();
          } else {
            alert(data);
          }
        })
        .catch((err) => {
          alert(err);
        });
    }
  });
  isDoneBtn.forEach((el) => {
    el.addEventListener("click", (e) => {
      const taskId = e.target.closest(".checked").dataset.task;
      console.log(taskId);

      fetch("process/ajaxHandler.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `action=taskState&taskId=${encodeURIComponent(taskId)}`,
      })
        .then((res) => res.text())
        .then((data) => {
          if (data.trim() === "1") {
            window.location.reload();
          } else {
            alert(data);
          }
        })
        .catch((err) => alert(err));
    });
  });
});
