<html>
<body>


<?php
$con = mysqli_connect("localhost","root","","project"); //connect to database
if (!$con){
die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}

$query="SELECT ID,NAME,ROLE,DEPARTMENT,TASK,START,END FROM announcement";
$qQuery=$con->prepare($query);
$result=$qQuery->execute();
$result=$qQuery->get_result();
if(!$result){
    die("SELECT query failed<br>".$con->error);
}
else{
    echo "SELECT QUERY SUCCESS<br>";
}

$nrows=$result->num_rows;
echo "number of rows =$nrows<br>";

if ($nrows>0){
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>ID</th><th>Name</th><th>Role</th><th>Department</th><th>Task</th><th>Start</th><th>End</th><tr>";


    while($row=$result->fetch_assoc()){
        echo "<tr>";
        
        echo "<td>";
        echo $row['ID'];
        echo "</td>";
        
        echo "<td>";
        echo $row['NAME'];
        echo "</td>";
        
        echo "<td>";
        echo $row['ROLE'];
        echo "</td>";
        
        echo "<td>";
        echo $row['DEPARTMENT'];
        echo "</td>";
        
        echo "<td>";
        echo $row['TASK'];
        echo "</td>";
        
        echo "<td>";
        echo $row['START'];
        echo "</td>";
        
        echo "<td>";
        echo $row['END'];
        echo "</td>";
        
        echo "</tr>";
    }
    echo "</table>";
}

else{
    echo "0 records<br>";
}

?>
</body>
</html>