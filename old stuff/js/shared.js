function toggleMenu() {
  const menu = document.getElementById("topnav");
  if (menu.className.includes("expanded")) {
    menu.className = "topnav";
  } else {
    menu.className = "topnav expanded";
  }
}

function removeMessage(id) {
  let message = document.getElementById("fw-message-" + id);
  if (message !== null && message !== undefined) {
    message.className += " shrink";
    setTimeout(() => {
      message.remove();
    }, 500);
  }
}

function insertAfter(refNode, nodeToInsert) {
  // why this isn't implemented is beyond me
  refNode.parentNode.insertBefore(nodeToInsert, refNode.nextSibling);
}

function addEventListeners() {
  window.addEventListener("online", function () {
    let offlineMessage = document.getElementById("fw-message-offline-message");
    if (offlineMessage !== null && offlineMessage !== undefined) {
      removeMessage("offline-message");
    }
  });
  window.addEventListener("offline", function () {
    let message = document.createElement("div");
    message.innerHTML = "<p>You are offline. Make sure you connect back to the internet before you submit anything.</p><button type=\"button\" class=\"close\" aria-label=\"Close\" onclick=\"removeMessage('offline-message')\"><span aria-hidden=\"true\">&times;</span></button>";
    message.className = "container failure";
    message.id = "fw-message-offline-message";

    document.body.insertBefore(message, document.querySelector(".container"));
  });
  window.onkeydown = function (e) {
    if (e.key === "ArrowUp") {
      window.onkeydown = function (e) {
        if (e.key === "ArrowUp") {
          window.onkeydown = function (e) {
            if (e.key === "ArrowDown") {
              window.onkeydown = function (e) {
                if (e.key === "ArrowDown") {
                  window.onkeydown = function (e) {
                    if (e.key === "ArrowLeft") {
                      window.onkeydown = function (e) {
                        if (e.key === "ArrowRight") {
                          window.onkeydown = function (e) {
                            if (e.key === "ArrowLeft") {
                              window.onkeydown = function (e) {
                                if (e.key === "ArrowRight") {
                                  window.onkeydown = function (e) {
                                    if (e.key === "b") {
                                      window.onkeydown = function (e) {
                                        if (e.key === "a") {
                                          let message = document.createElement("div");
                                          message.innerHTML = "<p>&#8593; &#8593; &#8595; &#8595; &#8592; &#8594; &#8592; &#8594; B A</p><button type=\"button\" class=\"close\" aria-label=\"Close\" onclick=\"removeMessage('konami')\"><span aria-hidden=\"true\">&times;</span></button>";
                                          message.className = "container success";
                                          message.id = "fw-message-konami";

                                          document.body.insertBefore(message, document.querySelector(".container"));
                                        }
                                      };
                                    }
                                  };
                                }
                              };
                            }
                          };
                        }
                      };
                    }
                  };
                }
              };
            }
          };
        }
      };
    }
  };
}

function makeid(length) {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < length; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

function doModal(heading, content) {
  var id = makeid(10);
  var html = '<div id="' + id + '" class="modal fade">';
  html += '<div class="modal-dialog modal-dialog-centered">';
  html += '<div class="modal-content">';
  html += '<div class="modal-header">';
  html += '<a class="close" data-dismiss="modal">×</a>';
  html += '<h1>' + heading + '</h1>';
  html += '</div>';
  html += '<div class="modal-body">';
  html += content;
  html += '</div>';
  html += '</div>';
  html += '</div>';
  html += '</div>'; // modalWindow
  document.body.innerHTML += html;
  $("#" + id).modal();
  $("#" + id).on('shown.bs.modal', function() {
      $("#" + id).focus();
      document.body.className = "modal-open";
  });
  $("#" + id).on('hidden.bs.modal', function() {
      document.body.removeChild(document.getElementById(id));
  });
}


function hideModal() {
  for (let backdrop of document.body.querySelectorAll(".modal-backdrop.in")) {
      backdrop.style.display = "none";
  }
}

function resolveData(object) {
  let FD = new FormData();

  for (let name in object) {
      FD.append(name, object[name]);
  }

  return FD;
}
