<?php
if(isset($_POST['signup-submit'])){
    
    require 'dbh.inc.php';

    $username = $_POST['user_name'];
    $companyName = $_POST['company_name'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $passwordReapeat = $_POST['pwd-repeat'];
    $userId = null;

    if(empty($username) || empty($companyName) || empty($email) || empty($password) || empty($passwordReapeat)){
        header("Location: ../pages/signup.php?error=emptyfields&uid=" .$username ."&mail=".$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../pages/signup.php?error=invalidmailuid");
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../pages/signup.php?error=invalidmail&uid=" .$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../pages/signup.php?error=invaliduid&mail=" .$email);
        exit();
    }
    else if($password !== $passwordReapeat){
        header("Location: ../pages/signup.php?error=passwordcheck&mail=" .$email . "&uid=" .$username);
        exit();
    }
    else {
        $sql = "SELECT user_id FROM users WHERE user_id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){ 
                header("Location: ../pages/signup.php?error=usertaken&mail=" .$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../pages/signup.php?error=sqlerror");
                    exit();   
                }
                else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                }
            }
        }
    }
    mysqli_stmt_close($stmt);

    $sql = "SELECT * FROM users WHERE email = '$email';";
    $result = mysqli_query($conn, $sql);

    $resCheck = mysqli_num_rows($result);
    if($resCheck > 0){
        $userId = mysqli_fetch_assoc($result);
        $userId = $userId['user_id'];
    };

    $sql = "SELECT client_id FROM client WHERE client_id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/signup.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $companyName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
            $sql = "INSERT INTO client (client_name, user_id) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../pages/signup.php?error=sqlerror");
                exit();   
            }
            else{
                mysqli_stmt_bind_param($stmt, "ss", $companyName, $userId);
                mysqli_stmt_execute($stmt);
                header("Location: ../pages/signup.php?signup=success");
                exit();  
            }
        }

mysqli_stmt_close($stmt);
mysqli_close($conn);
}

else {
    header("Location: ../pages/signup.php?");
    exit();
}