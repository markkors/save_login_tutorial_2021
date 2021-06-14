<?php
// include autoload for loading classes
include_once("../includes/autoloader.php");
// include login checker
include_once("../includes/login_checker.php");

$db= new database();
$users = new user($db->conn);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// set response code - 200 OK
http_response_code(200);
if($json = $users->getAllUsers()) {
    http_response_code(200);
    echo $json;
} else {
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no users found
    echo json_encode(
        array("message" => "No users found.")
    );
}
?>
