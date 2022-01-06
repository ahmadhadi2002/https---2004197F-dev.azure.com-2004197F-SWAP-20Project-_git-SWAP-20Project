<?php 
session_start();
if (isset($_GET["token"])) {
    include 'config.php';
    $sql = "UPDATE user SET status='1' WHERE token='{$_GET["token"]}'";
    mysqli_query($conn, $sql);
    
    $showUserId = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM user WHERE token='{$_GET["token"]}'"));
    $_SESSION['user_id'] = $showUserId['ID'];
    header("Location: welcome.php");
} else {
    header("Location: register.php");
}

?>