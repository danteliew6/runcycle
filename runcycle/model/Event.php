<?php
    class Event{
        private $event_id;
        private $username;
        private $title;
        private $start_point;
        private $end_point;
        private $event_datetime;
        private $event_desc;
        private $capacity;
        private $activity;
        private $duration;
        private $distance;


        public function __construct($event_id, $username, $title, $start_point, $end_point, 
        $event_datetime, $event_desc, $capacity, $activity, $duration, $distance){
            $this->event_id = $event_id;
            $this->username = $username;
            $this->title = $title;
            $this->start_point = $start_point;
            $this->end_point = $end_point;
            $this->event_datetime = $event_datetime;
            $this->event_desc = $event_desc;
            $this->capacity = $capacity;
            $this->activity = $activity;
            $this->duration = $duration;
            $this->distance = $distance;

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

        public function getCapacity() {
            return $this->capacity;
        }
        
        public function getActivity() {
            return $this->activity;
        }

        public function getDuration() {
            return $this->duration;
        }

        public function getDistance() {
            return $this->distance;
        }

    }
?>