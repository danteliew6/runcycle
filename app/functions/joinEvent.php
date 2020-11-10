<?php
    session_start();
    require_once "common.php";
    $dao = new ParticipantsDAO();
    
    
    $isAddOk = $dao -> joinEvent($_GET['event_id'], $_SESSION['token']);
    // var_dump($_GET['event_id'], $_SESSION['token'], $_GET['content']);
    

    $result_arr = array();
    $result_arr["added"] = $isAddOk;

    if ($isAddOk){
        // set response code - 200 OK
        http_response_code(200);

        // show products data in json format
        echo json_encode($result_arr);
    }
    else {

      
        // tell the user no items found
        echo json_encode(
            array("message" => $isAddOk));

        // set response code - 404 Not found
        http_response_code(404);
    }
 
?>