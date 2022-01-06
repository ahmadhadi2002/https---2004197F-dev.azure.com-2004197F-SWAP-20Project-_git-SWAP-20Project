<html>
<body>





<?php
session_start();

$con = mysqli_connect("localhost","root","","project"); 
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); 
}

$query= $con->prepare("INSERT INTO `announcement` (`NAME`,`ROLE`,`DEPARTMENT`,`TASK`,`START`,`END`) VALUES (?,?,?,?,?,?)");

$name=$_SESSION['user_name'];
$role = $_SESSION['user_role'];
$department = $_SESSION['user_department'];
$task = $_POST["task"];
$start = $_POST["start"];
$end = $_POST["end"];

$query->bind_param('ssssss', $name, $role , $department , $task , $start , $end ); //bind the parameters

if ($query->execute()){ 
    header("Location: http://localhost/project/announcement/show.php");
    
}else{
    echo "Error executing query.";
}
?>
</body>
</html>
