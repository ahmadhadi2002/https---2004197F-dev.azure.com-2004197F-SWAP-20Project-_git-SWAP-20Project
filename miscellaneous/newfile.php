<?php
$con = mysqli_connect("localhost","root","","project"); 
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); 
}
$query= $con->prepare("SELECT ID,NAME,ROLE,DEPARTMENT,TASK,START,END FROM announcement WHERE ID= ?");
$id=$_POST["update"];
$query->bind_param('s', $id); //bind the parameters
if ($query->execute()){ 
    header("location: http://localhost/project/show.php");
    exit();
}else{
    echo "Error executing query.";
}
?>



