<?php
    session_start();
    require_once "common.php";
    $dao = new EventDAO(); 
    
    $isAddOk = $dao -> addEvent($_SESSION['token'], $_GET['title'], $_GET['start_point'], $_GET['end_point'],
    $_GET['event_datetime'], $_GET['event_desc'], $_GET['capacity'], $_GET['activity'], $_GET['duration'], $_GET['distance']);
    
    // add yourself to participants

    $event = $dao -> getNewestEvent();
    $eventId = $event->getEventId();
    $participants_dao = new ParticipantsDAO();
    $addParticipant = $participants_dao -> joinEvent($eventId, $_SESSION['token']);    

    

    if ($isAddOk and $addParticipant){
        header("Location: ../home.html");
        exit();
    }
    else {
        var_dump($_SESSION['token'], $_GET['title'], $_GET['start_point'], $_GET['end_point'],
        $_GET['event_datetime'], $_GET['event_desc'], $_GET['capacity'], $_GET['activity'], $_GET['duration'], $_GET['distance']);
        echo "addEvent Error";
        header("Location: ../create_events.html");
    }
 
?>