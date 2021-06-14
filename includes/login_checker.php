<?php
// login checker for 'customer' access level
$home_url = core::$home_url;
core::init();
$access_level = null;

if(isset($_GET['action'])) {
    $action = $_GET['action'];
    if($action == "logout") {
        unset($_SESSION['user']);
        session_destroy();
    }
}

// if access level was not 'Admin', redirect him to login page
if (isset($_SESSION['user']) && $_SESSION['user']->userid  = session_id()) {
    $access_level = $_SESSION['user']->access_level;
} else {
    // require login
    header("Location: {$home_url}login.php?action=login");
}
