<?php
    require_once "common.php";
    $dao = new UserDAO();

    $username = $_POST['username'];
    $password = $_POST['password'];

    // var_dump($username, $password);
    // var_dump($dao -> validateUser($username, $password));

    $message = 'Invalid login details';
    if($dao->validateUser($username, $password)) {
        session_start();
        $message = 'Login successful!';
        $_SESSION['token'] = $username;
        header("Location: ../home.html");
        exit();
    }
    else {
        echo "<script type='text/javascript'>
        alert('$message');
        window.location.href='../login.html?error=true';
        </script>";
       
    }
 
    echo $message;
    // echo $_SESSION['token'];
?>