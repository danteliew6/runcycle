<?php
// include database and object files
require_once "common.php";

session_start();


$conn = new ConnectionManager();
$pdo = $conn->getConnection();

$sql = "SELECT * FROM `participants` where username = :username";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $_SESSION['token'], PDO::PARAM_STR);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$result = [];
while($row = $stmt->fetch()){
    $result[] = new Participants($row["event_id"],$row["username"]);
}

$stmt = null;
$pdo = null;

$result_arr = array();
$result_arr["records"] = array();
$dao = new EventDAO();
foreach ($result as $participants) {
    $data = $dao -> getEvent($participants->getEventId());
    // check if more than 0 record found
    if(isset($data)) {
        $event_datetime = $data->getEventDateTime();
        $event_datetime = strtotime($event_datetime);
        $now = getdate();
        if ($event_datetime >= $now[0]) {
        // products array    
        $dao2 = new ParticipantsDAO();
        $data2 = $dao2 -> getParticipants($participants->getEventId());
    
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
        }
    }    
}




if(isset($result_arr)) {
    
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