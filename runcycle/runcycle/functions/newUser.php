<?php
    require_once "common.php";
    $dao = new UserDAO();


    if (isset($_POST['username']) && isset($_POST['email']) && $_POST['password'] == $_POST['confirm_password']) {
        $isAddOk = $dao -> newUser($_POST['username'], $_POST['password'], $_POST['email']);
        header("Location: ../sample_login.html");
        exit();
    }

    header("Location: ../sample_register.html?error=true");
 
?>