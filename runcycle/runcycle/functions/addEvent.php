<?php
    session_start();
    require_once "common.php";
    $dao = new EventDAO();

    
    $isAddOk = $dao -> addEvent($_SESSION['token'], $_GET['title'], $_GET['start_point'], $_GET['end_point'], $_GET['event_datetime'], $_GET['event_desc'], $_GET['capacity']);
    
    if ($isAddOk){
        header("Location: ../event.html");
        exit();
    }
    else {
        echo "fuck gg";
    }
 
?>