<?php
include_once('../backend/util.php');

/**
 * Adds a set of Accept/Reject buttons to the page.
 * This had to be a PHP function because, this way, we can have multiples of these (due to the UUID).
 */
function includeARComponent() {
    $UUID = generatePassword(8);
?>
<p id="ar-container-<?php echo $UUID ?>">
    <button type="button" onclick="changeResponse('accept', '<?php echo $UUID ?>');" class="accept half-width" id="accept-button-<?php echo $UUID ?>">Accept</button>
    <button type="button" onclick="changeResponse('reject', '<?php echo $UUID ?>'); showEmailResponse()" class="decline half-width" id="decline-button-<?php echo $UUID ?>">Decline</button>
    <input type="hidden" name="response" value="" id="ar-response-<?php echo $UUID ?>" />
    <br><div id="checkbox_label" style="display: none"><input type="checkbox" name="send_email" value="true"><b>Send email with response</b></div>
</p>
<?php 
    // Only add this script part down here since we want the submit button to be disabled.
    // Yes, this PHP code is only existing just to comment.
?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.body.querySelector("input[type=submit]").disabled = false;
    });
    function showEmailResponse() {
        //document.getElementById("send_email").style.display = "inline";
        document.getElementById("checkbox_label").style.display = "inline-block";
    }
</script>
<?php } ?>
<script src="<?php API_URL ?>javascript/accept_reject.js"></script>
