<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","project");
if (!$con){
die('Could not connect: ' . mysqli_connect_errno()); 
}
if($_POST["startdate"]!= "" && $_POST["enddate"]!="" && $item = $_POST["item"]!=""){
$query= $con->prepare("INSERT INTO `planner` (`Start Date`, `End Date` ,`Item`) VALUES
(?,?,?)");
$sdate=$_POST["startdate"];
$edate=$_POST["enddate"];
$item = $_POST["item"];
$query->bind_param('sss',$sdate,$edate,$item); //bind the parameters

if ($query->execute()){ //execute query
    header("Location: http://localhost/project/plan&comment/index.php");
    exit();
}else{
 echo "Error executing query.";
}
}else{
    echo "<script>alert('Please ensure there are no empty fields')
window.location.href='http://localhost/project/plan&comment/index.php'</script>";  
}
?>
</body>
</html>