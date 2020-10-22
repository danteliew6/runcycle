<?php
    class ParticipantsDAO{

        // pass in comment details, adds the comment into the database
        public function joinEvent($event_id, $username) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            
            $sql = "INSERT INTO `participants` (`event_id`, `username`) VALUES (:event_id, :username)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);


            $isOk = $stmt->execute();
        
            $stmt = null;
            $pdo = null;
        
            return $isOk;
        }

        //by inserting an event_id as parameter, get all the participants for that event
        public function getParticipants($event_id) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            
            $sql = "SELECT * FROM `participants` where event_id = :event_id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            $result = [];
            while($row = $stmt->fetch()){
                $result[] = new Participants($row["event_id"],$row["username"]);
            }

            $stmt = null;
            $pdo = null;

            return $result;
        }

        public function checkJoined($event_id, $username) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            
            $sql = "SELECT * FROM `participants` where event_id = :event_id and username = :username";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            $result = [];
            while($row = $stmt->fetch()){
                $result[] = new Participants($row["event_id"],$row["username"]);
            }

            $stmt = null;
            $pdo = null;

            return $result;
        }

        public function removeParticipant($event_id, $username) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            
            $sql = "DELETE FROM `participants` where event_id = :event_id and username = :username";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $isRemoved = $stmt->execute();



            $stmt = null;
            $pdo = null;

            return $isRemoved;
        }

//         public function getHigherThanID($id, $limit){
//             $conn = new ConnectionManager();
//             $pdo = $conn->getConnection();
            
//             $sql = "SELECT * FROM `post` WHERE `id` > :id ORDER BY `id` DESC LIMIT :lim";

//             $stmt = $pdo->prepare($sql);
//             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//             $stmt->bindParam(':lim', $limit, PDO::PARAM_INT);
//             $stmt->setFetchMode(PDO::FETCH_ASSOC);
//             $stmt->execute();

//             $result = [];
//             while($row = $stmt->fetch()){
//                 $result[] = new Post($row["id"],$row["title"],$row["username"],$row["likes"]);
//             }

//             $stmt = null;
//             $pdo = null;

//             return $result;
//         }
//     }


}
// ?>