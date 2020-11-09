<?php
    require_once "common.php";
    $dao = new UserDAO();
    $isValidUsername = !empty($_POST['username']);
    $isValidEmail = !empty($_POST['email']) && strpos($_POST['email'], '@') !== false;
    $isValidPassword = !empty($_POST['password']) && $_POST['password'] == $_POST['confirm_password'];

    if ($isValidUsername && $isValidEmail && $isValidPassword) {
        $isAddOk = $dao -> newUser($_POST['username'], $_POST['password'], $_POST['email']);
        header("Location: ../login.html");
        exit();
    }

    $errorMessage = '';
    
    $errorMessage .= !$isValidEmail ? 'email' : '';
    $errorMessage .= !$isValidUsername ? 'username' : '';
    $errorMessage .= !$isValidPassword ? 'password' : '';
    
    // echo $errorMessage;
    header("Location: ../register.html?error=$errorMessage");
    exit();

 
?>