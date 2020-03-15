<?php
session_start();

include_once('./util.php');

/**
* A function to do a javascript alert 
*/
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

/**
 * redirects based on account type. 
 * This mehtod can also force a redirect to login page.
 *
 * @param string       accounttype
 * @return void              
 */
function redirect($atype){

    if ($atype == $GLOBALS['admin_type']) {
      header("Location: ./admin/admin.php");
      //exit;
    } else if ($atype == $GLOBALS['student_type']) {
      header("Location: ./student/student.php");
      exit();
    } else if ($atype == $GLOBALS['secretary_type']) {
      header("Location: ../secretary.php");
      exit();
    } else if ($atype == $GLOBALS['chair_type']) {
    } else if ($atype == $GLOBALS['dean_type']) {
    } else if ($atype == $GLOBALS['instructor_type']) {
      header("Location: ../faculty.php");
      exit();
    } else if ($atype == $GLOBALS['employer_type']) {
  
    }else {
    header("Location: ./newback/logout.php");
    exit();
    }
  }
  
/**
* A function for logging a message to the console
*/
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }
  
/**
 * Generates an alphanumeric password using uppercase and lowercase
 * letters of a specified length.
 *
 * @param int       $length     The specified length of the password.
 * @return string               A password of specified length.
 */
function generatePassword($length)
{
    $characters = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8',
        '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w',
        'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
        'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U',
        'V', 'W', 'X', 'Y', 'Z'
    ];

    $result = "";

    for ($i = 0; $i < $length; $i++) {
        $result = $result . $characters[rand(0, 62)];
    }

    return $result;
}

/**
 * Sends an e-mail with the specified subject to a desired recipient.
 * The e-mail will be sent as an RFC multipart-alternative e-mail with
 * a plaintext part and an HTML part. The standards conform to RFC1341.
 *
 * For line breaks, use \n; this function will use a regular expression
 * to replace all \n's to their appropriate line breaks (that is,
 * plaintext must use \r\n, and HTML must close a paragraph, then \r\n,
 * then start a new paragraph.)
 *
 * MIME boundaries are randomly generated using a call to
 * generatePassword(8).
 *
 * @example backend/create-user.php     We use a call of this to welcome a new user in the system.
 *
 * @param string    $email      The e-mail address of the recipient.
 * @param string    $subject    The subject of the e-mail.
 * @param string    $message    The message contents of the e-mail.
 *
 * @return bool     True if mail was sent, false otherwise. Same as a normal call to mail().
 */
function sendEmail($email, $subject, $message)
{
    $BOUNDARY = "mime-boundary-" . generatePassword(8);
    $EMAIL_FROM = MAIL_FROM . " <" . MAIL_FROM . ">";

    // The plaintext part of the email (changing \n to \r\n)
    $PLAIN_TEXT_PART = preg_replace("/\n/", "\r\n", $message) .
        "\r\nTo go back to the field work system, go to " . API_URL . " in your web browser.";

    // The HTML part of the e-mail (changing \n to a paragraph end tag, \r\n, then a paragraph begin)
    $HTML_PART = file_get_contents("email-template/email-top.html", FILE_USE_INCLUDE_PATH)
        . "<p>" . preg_replace("/\n/", "</p>\r\n<p>", $message) .
        "</p>\n<p><a href=\"" . API_URL . "\">Click here to go to the fieldwork system.</a></p>" .
        file_get_contents("email-template/email-bottom.html", FILE_USE_INCLUDE_PATH);

    // Right now, this is how I incorporate RFC-compliant multipart e-mail.
    // This string builder code isn't exactly pretty.
    $FINAL_MESSAGE = "--" . $BOUNDARY . "\r\nContent-type: text/plain; charset=UTF-8\r\n\r\n" .
        $PLAIN_TEXT_PART . "\r\n\r\n\r\n--" . $BOUNDARY .
        "\r\nContent-type: text/html; charset=UTF-8\r\n\r\n" . $HTML_PART .
        "\r\n\r\n\r\n--" . $BOUNDARY . "--";

    return mail(
        $email,
        $subject,
        $FINAL_MESSAGE,
        "From: " . $EMAIL_FROM . "\r\n" .
            "Reply-To: " . $EMAIL_FROM . "\r\n" .
            "Return-Path: " . $EMAIL_FROM . "\r\n" .
            "MIME-Version: 1.0" .  "\r\n" .
            "Content-type: multipart/alternative; boundary=\"$BOUNDARY\"\r\n\r\n"
    );
}

/**
 * Checks to see if the logged in user is a desired type.
 * If the user is not logged in, the user will be booted back to login.php.
 * If the user isn't logged in as the desired type of user, the user will be booted
 * back to home.php.
 *
 * IN THE FUTURE: Remove the redirect from this function and implement it in an if statement.
 *
 * @example student.php             student.php is only accessable if the user is a student.
 *
 * @param string    $desiredType    Required type of user.
 * @return bool     True if user is logged in as desired type, false otherwise.
 */
function checkUserType($desiredType)
{
    if ($_SESSION['user_type'] != $desiredType ) {
        setMessage(false, "You need to be " . $desiredType . " to access this page.");
        if ($_SESSION['user_type'] == null){
            $test = "null";
        } else {
            $test = $_SESSION['user_type'];
        }
        header("Location: " . API_URL . "login.php?" . $test, true, 301);
        return false;
    } elseif (!isset($_SESSION['id_key'])) {
        setMessage(false, "You need to be " . $desiredType . " to access this page.");
        header("Location: " . API_URL . "login.php", true, 301);
        return false;
    }
    return true;
}

/**
 * Check if the user is one of the specified types.
 * If they are not, this method returns false.
 * If they are, this method returns true.
 *
 * @example create-user.php     The user must be of a certain type in order to create other users.
 *
 * @param array         $desiredTypes         A list of valid types that the user must be one of.
 * @return boolean                            True if the user is a type specified in the passed in array; false otherwise.
 */
function checkUserTypeOfMultiple($desiredTypes)
{
    $isValidType = in_array($_SESSION["user_type"], $desiredTypes) && isset($_SESSION["id_key"]);
    if (!$isValidType) {
        $desiredTypesString = "You need to be logged in as a ";
        for ($i = 0; $i < count($desiredTypes); $i++) {
            if ($i == (count($desiredTypes) - 1)) {
                $desiredTypesString = $desiredTypesString . "or " . $desiredTypes[$i];
            } else {
                if (count($desiredTypes) > 2) {
                    $desiredTypesString = $desiredTypesString . $desiredTypes[$i] . ", ";
                } else {
                    $desiredTypesString = $desiredTypesString . $desiredTypes[$i] . " ";
                }
            }
        }
        $desiredTypesString = $desiredTypesString . " to access this page.";
        setMessage(false, $desiredTypesString);
    }
    return $isValidType;
}

/**
 * Gives the user a message on a successful/failed action.
 *
 * This function works hand in hand with components/message.php;
 * Ideally, this function should be thrown in a backend script,
 * then when a backend script redirects the user to another page,
 * that page includes the skeleton head (and therefore, the message component).
 *
 * The message component takes care of stylizing and displaying the message;
 * styles for which are located in the shared stylesheet.
 *
 * @param boolean $messageSuccess       Whether or not the action performed was successful.
 * @param string $message               The contents of the message.
 */
function setMessage($messageSuccess, $message)
{
    session_start();
    $_SESSION["msg_success"] = $messageSuccess;
    $_SESSION["msg"] = $message;
}

/**
 * Clears the message (if one is set).
 */
function clearMessage()
{
    session_start();
    unset($_SESSION["msg_success"]);
    unset($_SESSION["msg"]);
}

/**
 * Generates a banner-like number for an employer.
 * Starts with E, followed by 8 digits.
 * 
 * @return string A banner-like ID number for an employer.
 */
function generateEmployerID()
{
    return "E" . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
}

/**
 * Returns the item at a specified index of an associative array.
 * 
 * For example: Say you have an associative array:
 * array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
 * 
 * Getting index "0" will yield "35."
 * 
 * @param array $array       The associative array to search.
 * @param integer $index     The index to get.
 * @return object            The object at the specified index.
 */
function get_index_of_assoc($array, $index)
{
    return $array[array_keys($array)[$index]];
}

/**
 * Makes a new textbox with the given text and form name.
 * 
 * @param string $text          The text to be displayed next to the text box.
 * @param string $name          The name to be given with the form control.
 * @param boolean $default      Whether or not the box should initially be checked.
 */
function checkBox($text, $name, $default) {
    ?>
    <label style="text-align: left;">
        <input type="checkbox" name="<?php echo($name); ?>" <?php 
            if ($default) {
                ?>checked<?php 
            }
        ?> />
        <?php echo($text); ?>
    </label>
    <?php 
}

/**
 * A test function that echoes "Hello world!" onto the page and exits.
 * This function should be used to test a successful import of util.php.
 *
 * @return integer test() will always return 1.
 */
function test()
{
    echo "Hello world!";
    return 1;
}



?>
