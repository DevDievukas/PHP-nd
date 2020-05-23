<?php

if(isset($_POST['login-submit'])){

    require 'dbh.inc.php';

    $username = $_POST['user_name'];
    $password = $_POST['pwd'];

    if(empty($username) || empty($password)){
        header("Location: ../pages/login.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE user_name=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['password']);
                if($pwdCheck == false){
                    header("Location: ../pages/login.php?error=wrongpwd");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];

                    header("Location: ../pages/main.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../pages/login.php?error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: ../pages/login.php?error=nouser");
                exit();
            }
        }
    }
}
else {
    header("Location: ../index.html");
    exit();
}