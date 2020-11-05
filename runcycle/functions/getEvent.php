<?php
// include database and object files
require_once "common.php";
$dao = new EventDAO();


$data = $dao -> getEvent($_GET['event_id']);
// check if more than 0 record found


if(isset($data)) {

    // products array
    $result_arr = array();
    $result_arr["records"] = array();

    $dao2 = new ParticipantsDAO();
    $data2 = $dao2 -> getParticipants($_GET['event_id']);

    $item = array(
        "event_id" => $data->getEventId(),
        "username" => $data->getUsername(),
        "title" => $data->getTitle(),
        "start_point" => $data->getStartPoint(),
        "end_point" => $data->getEndPoint(),
        "event_datetime" => $data->getEventDateTime(),
        "event_desc" => $data->getEventDesc(),
        "capacity" => $data->getCapacity(),
        "activity" => $data->getActivity(),
        "duration" => $data->getDuration(),
        "distance" => $data->getDistance(),
        "participants" => sizeof($data2)
    );

    array_push($result_arr["records"], $item);
    
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
?>