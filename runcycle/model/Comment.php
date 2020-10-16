<?php
class Comment {
    private $event_id;
    private $username;
    private $content;
    private $created_datetime;

    public function __construct($event_id, $username, $content, $created_datetime){
        $this->event_id = $event_id;
        $this->username = $username;
        $this->content = $content;
        $this->created_datetime = $created_datetime;
    }

    public function getEventId() {
        return $this->event_id;
    }   

    
    public function getUsername() {
        return $this->username;
    }   

    public function getContent() {
        return $this->content;
    }   

    public function getCreatedDatetime() {
        return $this->created_datetime;
    }   

}

?>