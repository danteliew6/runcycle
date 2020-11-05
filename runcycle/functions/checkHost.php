<?php
// required headers

//User must pass in event_id and username as queries (e.g event_id=1&username=john)
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once 'common.php';

$conn = new ConnectionManager();

$dao = new EventDAO();

$event = $dao -> getEvent($_GET['event_id']);

$username = $event->getUsername();



if ($username == $_SESSION['token']) {
    http_response_code(200);

}
else {
    http_response_code(404);

    // tell the user no items found
    echo json_encode(
        array("message" => "No items found.")
    );
}

?>