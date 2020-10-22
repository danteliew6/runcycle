<?php
class Participants {
    private $event_id;
    private $username;


    public function __construct($event_id, $username){
        $this->event_id = $event_id;
        $this->username = $username;
    }

    public function getEventId() {
        return $this->event_id;
    }   

    
    public function getUsername() {
        return $this->username;
    }   

}

?>