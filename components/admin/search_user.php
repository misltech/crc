<?php
include_once('component_template.head.php');
modalHead("searchUser");
?>
<div class="modal-header">
    <h1>Search User</h1>
</div>
<div class="modal-body" id="searchUserForm">
    <label>
        <p>Look up by e-mail:</p>
        <input type="email" name="email" placeholder="some.email@hawkmail.newpaltz.edu">
    </label>
</div>
<div class="modal-footer">
    <button onclick="searchUserAJAX();" data-dismiss="modal">Search</button>
</div>
<script>
    function clearSearch() {
        location.reload();
    }

    function fetchProfileAJAX(e, p) {
        hideModal();
        let ajaj = new XMLHttpRequest();
        ajaj.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    let json = JSON.parse(this.responseText);
                    if (json == null || json == undefined || (Object.entries(json).length === 0 && json.constructor === Object)) {
                        doModal("Profile Not Found", "<p>This user's profile doesn't actually exist. Probably a database error?</p>");
                    } else {
                        let info = "<table>";
                        for (value in json) {
                            info += "<tr><td>" + value + "</td><td>" + json[value] + "</td></tr>";
                        }
                        info += "</table>"
                        doModal("Profile Information", info);
                    }
                }
            }
        }
        ajaj.open("POST", "backend/profile.php");
        ajaj.send(resolveData({
            "email": e,
            "user_type": p
        }));
    }

    function searchUserAJAX() {
        hideModal();
        let ajaj = new XMLHttpRequest();
        let e = document.getElementById("searchUserForm").children[0].children[1].value;
        ajaj.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    $("#searchUser").css("display", "none");
                    let json = JSON.parse(this.responseText);
                    if (json == null || json == undefined || (Object.entries(json).length === 0 && json.constructor === Object)) {
                        doModal("User Not Found", "<p>This user doesn't exist.</p>");
                    } else {
                        doModal(
                            "User Information",
                            '<p>E-mail:</p><p>' + json.email + '</p><p>&nbsp;</p>' +
                            '<p>Logged in at least once?</p><p>' + (json.first_time === "1" ? "Yes" : "No") + '</p><p>&nbsp;</p>' +
                            '<p>Last Access Timestamp:</p><p>' + json.last_access + '</p><p>&nbsp;</p>' +
                            // '<p>Password:</p><p>' + json.passcode + '</p><p>&nbsp;</p>' +
                            '<p>Banner ID:</p><p>' + json.banner_id + '</p><p>&nbsp;</p>' +
                            '<p>User type:</p><p>' + json.profile_type + '</p><p>&nbsp;</p>' +
                            '<p>Verified Profile Information:</p><p>' + (json.verified === "1" ? "Yes" : "No") + '</p>' +
                            (json.verified === "1" ? '<button onclick="fetchProfileAJAX(\'' + json.email + '\',\'' + json.profile_type + '\')" data-dismiss="modal">Fetch Profile</button>' : '') +
                            '<p>&nbsp;</p>' +
                            '<form method="POST" action="backend/profile.php"><input type="hidden" value="Remove User" name="submit_type">' +
                            '<input type="hidden" value="' + json.email + '" name="email">' +
                            '<p>Please, only hit this if you are very, VERY sure.</p>' +
                            '<button class="btn-danger">Delete User</button></form>'
                        );
                    }
                }
            }
        }
        ajaj.open("POST", "backend/admin/search-user.php");
        ajaj.send(JSON.stringify({
            "email": e
        }));
    }
</script>
<?php
include('component_template.foot.php');
?>