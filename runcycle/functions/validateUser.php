<?php
    require_once "common.php";
    $dao = new UserDAO();

    $username = $_POST['username'];
    $password = $_POST['password'];

    // var_dump($username, $password);
    // var_dump($dao -> validateUser($username, $password));

    $message = 'Access Denied';
    if($dao->validateUser($username, $password)) {
        session_start();
        $message = 'Login successful!';
        $_SESSION['token'] = $username;
        header("Location: ../createevent.html");
        exit();
    }
 
    echo $message;
    // echo $_SESSION['token'];
?>