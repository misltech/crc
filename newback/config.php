<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

/**
 * 
 * Database info
 */

$server = 'localhost';
$user = 'mitchelt6';
$pass = 'l2n1l4';
$db = 'mitchelt6_db';

/**
 * Database Tables
 * 
 */
$accounts = 's20_UserPass';

/**
 * Error codes
 * 
 */
$GLOBALS['IncorrectCredentials'] = 1;
$GLOBALS['InternalError'] = 504;

/**
 * User types based on database
 * Fill in details if you change them in db
 */
$GLOBALS['admin_type'] = 'admin';
$GLOBALS['student_type'] = 'student';
$GLOBALS['secretary_type'] = 'secretary';
$GLOBALS['chair_type'] = 'chair';
$GLOBALS['dean_type'] = 'dean';
$GLOBALS['instructor_type'] = 'instructor';
$GLOBALS['employer_type'] = 'employer';


/**
 * Use API_URL (without the dollar sign) instead.
 */
$API_URL = "https://cs.newpaltz.edu/p/f18-02/s20-v2/";

/**
 * The root of the web server (as an absolute URL).
 */
define("API_URL", "https://cs.newpaltz.edu/p/f18-02/s20-v2/");

/**
 * Use DEBUG (without the dollar sign) instead.
 */
$DEBUG = false;

/**
 * A constant that sets the state of debug mode.
 * If set to True, debug mode will be on. Otherwise, it won't.
 */
define("DEBUG", false);

/**
 * Used with the e-mail sender.
 * This defines the address where e-mails will send from.
 * It's generally good to send from the same server as the one
 * running this script.
 */
define("MAIL_FROM", "careers@wyvern.cs.newpaltz.edu");

/**
 * Where instructor syllabi should reside, in relation to
 * the /backend/ folder, and followed with a trailing slash.
 * 
 * For example: If both /backend/ and a /syllabi/ folder
 * resided at the project root: SYLLABI_DIR should be:
 * ../syllabi/
 * 
 * Permissions don't quite work right, therefore,
 * there's a test directory at:
 * /home/daltond2/syllabi_temp
 * with correct permissions.
 */
define("SYLLABI_DIR", "/var/www/projects/f18-02/s20-v2/syllabi/");

/**
 * An upper bound of how big syllabi files should be,
 * in bytes.
 * 
 * 5,242,880 bytes -> 5 megabytes.
 */
define("SYLLABI_MAX_SIZE", 5242880);

/**
 * Prevent a warning with strtotime();
 */
date_default_timezone_set("America/New_York");

// If util is actually on a web server
if (isset($_SERVER["HTTP_HOST"]) && isset($_SERVER["REQUEST_URI"])) {
    //If the HTTPS is not found to be "on"
    if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
        //Tell the browser to redirect to the HTTPS URL.
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
        //Prevent the rest of the script from executing.
        exit;
    }
}

