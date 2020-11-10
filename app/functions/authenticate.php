<?php
session_start();

if (isset($_SESSION['token'])) {
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