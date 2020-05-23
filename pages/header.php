<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <title>Document</title>
</head>
<body>
    <header>
    <nav class='header-nav'>
            <a href="#" class='logo-link'>
                <img class='header-logo' src="../assets/Logo.png" alt="logo">
            </a>
            <?php 
                if(isset($_SESSION['user_name'])){
                    echo '<h2>' . $_SESSION['user_name'] . '</h2>';
                }
            ?>
            <ul class='header-ul'>
                <li><a href="../index.html">Home</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>

        </nav>
    </header>