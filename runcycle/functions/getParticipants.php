<?php
// required headers

//User must pass in event_id as a query (e.g event_id=1)

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once 'common.php';

$conn = new ConnectionManager();

$dao = new ParticipantsDAO();
$data = $dao -> getParticipants($_GET['event_id']);

// check if more than 0 record found
if(isset($data)) {

    // products array
    $result_arr = array();
    $result_arr["records"] = array();

    foreach ($data as $participant) {

        $item = array(
            "event_id" => $participant->getEventId(),
            "username" => $participant->getUsername(),

        );

        array_push($result_arr["records"], $item);
    }
    // var_dump($result_arr);
    // Add info node (1 per response)
    $date = new DateTime(null, new DateTimeZone('Asia/Singapore'));
    $result_arr["info"] = array(
        "author" => "Runcycle",
        "response_datetime_singapore" => $date->format('Y-m-d H:i:sP')
    );

 
    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($result_arr);
}
else {
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no items found
    echo json_encode(
        array("message" => "No items found.")
    );
}

$stmt = null;
$pdo = null;
?>