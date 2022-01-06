<?php
include 'config.php';

if (isset($_POST['deletecomment'])){
    
    $id = $_POST['deletecomment'];
    
    $query = $con->prepare("DELETE FROM `comments` WHERE ID='$id'");
    $result = $query->execute();
    if (!$result) {
        echo "Error";
        die();
    }
    
    //logging of deleteinformation//
    $log = "DELETE FROM `comments` WHERE ID='$id'";
    $fp = fopen('log.txt', 'a');
    fwrite($fp, "\n".$log);
    fclose($fp); 

    header("Location: http://localhost/project/plan&comment/getcomments.php");
}
?>
