<?php
    class CommentDAO{

        // pass in comment details, adds the comment into the database
        public function addComment($event_id, $username, $content) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            
            $sql = "INSERT INTO `comment` (`event_id`, `username`, `content`) VALUES (:event_id, :username, :content)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);


            $isOk = $stmt->execute();
        
            $stmt = null;
            $pdo = null;
        
            return $isOk;
        }

        //by inserting an event_id as parameter, get all the comments for that specific event
        public function getComments($event_id) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            
            $sql = "SELECT * FROM `comment` where event_id = :event_id ORDER BY `created_datetime` DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            $result = [];
            while($row = $stmt->fetch()){
                $result[] = new Comment($row["event_id"],$row["username"],$row["content"],$row["created_datetime"]);
            }

            $stmt = null;
            $pdo = null;

            return $result;
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