<?php
    class UserDAO{

        public function newUser($username, $password, $email) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();

            $sql = "INSERT INTO `user` (`username`, `password`, `email`) VALUES (:username, :password_hashed, :email)";

            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password_hashed',$password_hashed , PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            $isOk = $stmt->execute();
     
            $stmt = null;
            $pdo = null;
        
            return $isOk;
        }

        public function validateUser($username, $password) {
        
            $user = $this->getUser($username);
            // No account with $username was found in Database.
            // Return false.
            if(!$user) {
                return false;
            }
        
            // Account with $username is found.
            // Now, do authentication.
            if(password_verify($password, $user->getPassword()) ) {
                // password is correct
                return true;
            }

            return false;
            }

        public function getUser($username) {
            $sql = "SELECT * FROM user where username = :username";
        
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
        
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);


            while($row = $stmt->fetch()) {
                return new User( $row['username'], $row['password'], $row['email']);
            }
        
            $stmt = null;
            $conn = null;
        
            return null;
        }



    }
?>