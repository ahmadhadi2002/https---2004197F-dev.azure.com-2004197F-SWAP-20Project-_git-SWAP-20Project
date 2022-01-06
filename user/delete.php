<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please Sign In First')</script>";
    header("Location: login.php");
}

include 'config.php';


                $sql = "DELETE FROM user WHERE ID='{$_SESSION['user_id']}'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Profile Has Been Deleted')</script>";
                    header("Location: login.php");
                    session_destroy();
                } else {
                    echo "<script>alert('Error Occurred, Delete Unsuccessful')</script>";
                    echo $conn->error;
                }


?>