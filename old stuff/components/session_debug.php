<?php
    // code for debugging session info below
    if (DEBUG) {
        ?>
<h1>⚠️ Notice ⚠️</h1>
<p>
    Debug mode is on. We HIGHLY recommend turning it off in production.
    To turn it off: open <code>backend/util.php</code> and change the statement that reads
    <code>define("DEBUG", True);</code> to read: <code>define("DEBUG", False);</code>.
    If you leave it on, session info will be shown, and more items will show up in the navigation
    bar. Don't do that -- really, don't.
</p>
<?php
    if (session_status() === PHP_SESSION_DISABLED) {
        ?><p>Sessions are disabled.</p><?php
    } elseif (session_status() === PHP_SESSION_ACTIVE) {
        if ($_SESSION !== [] && !is_null($_SESSION)) {
            ?>
<p>
    Session info:
</p>
<table>
    <tr>
        <th>Key</th>
        <th>Value</th>
    </tr>
    <?php
    foreach ($_SESSION as $key => $value) {
        ?><tr>
        <td><code><?php echo($key); ?></code></td>
        <td><code><?php echo($value); ?></code></td>
    </tr><?php
    } ?>
</table><?php
        } else {
            ?><p>Session is null.</p><?php
        }
    } else {
        ?><p>There is no session, currently.</p><?php
    }
    }
?>