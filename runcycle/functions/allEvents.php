<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once 'common.php';

$conn = new ConnectionManager();
$pdo = $conn->getConnection();

$sql = "SELECT * from event";

$stmt = $pdo->prepare($sql);
$isOk = $stmt->execute();

// check if more than 0 record found
if($isOk) {

    // products array
    $result_arr = array();
    $result_arr["records"] = array();

    while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $item = array(
            "event_id" => $event_id,
            "username" => $username,
            "title" => $title,
            "start_point" => $start_point,
            "end_point" => $end_point,
            "event_datetime" => $event_datetime,
            "event_desc" => $event_desc,
            "participants" => $participants,
            "capacity" => $capacity
        );

        array_push($result_arr["records"], $item);
    }

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