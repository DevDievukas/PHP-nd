<?php
session_start();
if(isset($_POST['website-submit'])){
    
    require 'dbh.inc.php';

    $userID = $_SESSION['userId'];
    $webAdress = $_POST['web_adress'];
    $developers = array();
    $clientID = null;

    $sql = "SELECT * FROM client WHERE user_id = '$userID';";
    $result = mysqli_query($conn, $sql);
    $resCheck = mysqli_num_rows($result);
    if($resCheck > 0){
        $clientID = mysqli_fetch_assoc($result);
        $clientID = $clientID['client_id'];
    };


    
    $sql = "SELECT * FROM employee WHERE position = 'Developer';";
    $result = mysqli_query($conn, $sql);
    $resCheck = mysqli_num_rows($result);
    if($resCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            array_push($developers, $row['employee_id']);
        }
    };

    if(empty($webAdress)){
        header("Location: ../pages/main.php?error=emptyfields&uid=" .$webAdress);
        exit();
    }
    else {
        $sql = "SELECT website_id FROM website WHERE website_id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/main.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $webAdress);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
                $sql = "INSERT INTO website (client_id, web_adress, employee_id) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../pages/main.php?error=sqlerror");
                    exit();   
                }
                else{
                    $employee = rand(0, sizeof($developers));
                    
                    mysqli_stmt_bind_param($stmt, "sss", $clientID, $webAdress, $employee);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../pages/main.php?signup=success");
                }
            }
        }
        
mysqli_stmt_close($stmt);
mysqli_close($conn);
    }
else {
    header("Location: ../pages/main.php");
    exit();
}