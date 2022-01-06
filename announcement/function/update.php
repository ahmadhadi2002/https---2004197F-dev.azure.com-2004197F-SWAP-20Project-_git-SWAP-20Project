<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","project"); //connect to database
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
$query= $con->prepare("UPDATE `announcement` SET TASK=?, START=?,END=?  WHERE ID=?");

$_id = $_POST["id"];
$task = $_POST["task"];
$start = $_POST["start"];
$end =$_POST["end"];
echo $_id;

$query->bind_param('ssss', $task, $start, $end, $_id); 
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