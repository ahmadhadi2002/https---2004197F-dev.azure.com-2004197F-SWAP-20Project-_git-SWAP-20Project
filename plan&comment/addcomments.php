<?php
include 'config.php';
if (isset( $_POST['addcomments']) ){
    
    $start = $con -> real_escape_string($_SESSION['start']);
    $end = $con -> real_escape_string($_SESSION['end']);
    $username = $con -> real_escape_string($_SESSION['username']);
    $department = $con -> real_escape_string($_SESSION['department']);
    $comment = $con -> real_escape_string($_POST['addcomment']);
    
    $query = $con->prepare("INSERT INTO `comments` (START, END, USERNAME, DEPARTMENT, COMMENT)
        VALUES ('$start','$end','$username','$department','$comment')");
    $result = $query->execute();
    if (!$result) {
        echo "Error";
        die();
    }
    else {
        $log= "('INSERT INTO `comments` (START, END, USERNAME, DEPARTMENT, COMMENT)
        VALUES ('$start','$end','$username','$department','$comment')')";
        $fp = fopen('log.txt', 'a');
        fwrite($fp, "\n".$log);
        fclose($fp); 
        header("Location: http://localhost/project/plan&comment/getcomments.php");
    }
}
?>