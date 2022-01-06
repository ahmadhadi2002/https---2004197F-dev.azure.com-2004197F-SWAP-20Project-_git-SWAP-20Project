<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","project"); 
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); 
}

$query= $con->prepare("DELETE FROM `announcement` WHERE ID=?");

$id=$_POST["delete"];


$query->bind_param('s', $id); //bind the parameters
$query-> store_result();
if ($query->execute()){ 
    header("location: http://localhost/project/announcement/show.php");
    exit();
}else{
    echo "Error executing query.";
}
?>
</body>
</html>
