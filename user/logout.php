<?php 

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please Sign In First')</script>";
    header("Location: login.php");
}

session_start();
session_destroy();

header("Location: login.php")

?>