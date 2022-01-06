<?php
session_start();

if ($_SESSION['user_role'] == null) {
    header("Location: /project/announcement/view.php");
}
else if ($_SESSION['user_role'] == 'admin'){
    header("Location: /project/announcement/show.php");
}
?>