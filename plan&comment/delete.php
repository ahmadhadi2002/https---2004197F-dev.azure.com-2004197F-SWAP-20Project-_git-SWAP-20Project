<?php
include 'config.php';
$query= $con->prepare("DELETE FROM planner WHERE id=?");
$id = $_POST['delete'];
$query->bind_param('s', $id); //bind the parameters
if ($query->execute()){
    header("Location: http://localhost/project/plan&comment/index.php");
    exit();
}else{
    echo "Error executing query.";
}
?>