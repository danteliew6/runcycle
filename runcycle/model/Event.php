<?php
    class Event{



        private $event_id;
        private $username;
        private $title;
        private $start_point;
        private $end_point;
        private $event_datetime;
        private $event_desc;
        private $participants;
        private $capacity;


        public function __construct($event_id, $username, $title, $start_point, $end_point, 
        $event_datetime, $event_desc, $participants, $capacity){
            $this->event_id = $event_id;
            $this->username = $username;
            $this->title = $title;
            $this->start_point = $start_point;
            $this->end_point = $end_point;
            $this->event_datetime = $event_datetime;
            $this->event_desc = $event_desc;
            $this->participants = $participants;
            $this->capacity = $capacity;
        }

        public function getEventId() {
            return $this->event_id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getStartPoint() {
            return $this->start_point;
        }

        public function getEndPoint() {
            return $this->end_point;
        }
        
        public function getEventDatetime() {
            return $this->event_datetime;
        }

        public function getEventDesc() {
            return $this->event_desc;
        }

        public function getParticipants() {
            return $this->participants;
        }

        public function getCapacity() {
            return $this->capacity;
        }

    }
?>