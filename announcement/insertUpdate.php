<!DOCTYPE html>
<html>
<body>



<?php 
$con = mysqli_connect("localhost","root","","project"); //connect to database
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}


$id=$_POST["update"];
$query=$con->prepare("SELECT ID,NAME,ROLE,DEPARTMENT,TASK,START,END FROM announcement WHERE ID= ? ");
$query->bind_param('s', $id); //bind the parameters

$result=$query->execute();
$result=$query->get_result();

if(!$result){
    die("SELECT query failed<br>".$con->error);
}
else{
    $nrows=$result->num_rows;

    if ($nrows>0){
        echo "<form action='/project/announcement/function/update.php' method='post'>";
        
        while($row=$result->fetch_assoc()){
            
            $id=$row['ID'];

            $name=$row['NAME'];
            $role=$row['ROLE'];
            $department=$row['DEPARTMENT'];
            $start=$row['START'];
            $end=$row['END'];
            $task=$row['TASK'];
            echo "<h1>EDIT ANNOUNCEMENT</h1>";
            //echo "<input type=text; name=id; value=$id; disabled; style=display:none> <br>";
            echo "DETAILS <br>";
            echo "Name: <input type=text value=$name > &emsp;" ;
            echo "Role: <input type=text value=$role readonly> &emsp;" ;
            echo "Department: <input type=text; readonly; value=$department ><br> <br>" ;
            echo "DATES <br>";
            echo "Start: <input type=date value=$start name=start> &emsp;" ;
            echo "End: <input type=date value=$end name=end><br> <br>" ;
            echo "Announcement: <textarea rows=4 cols=50 name=task> $task</textarea><br><br>";
            echo "<textarea name=id disabled; style=display:none> $id</textarea><br><br>";
            echo "<input type=submit value=SUbmit >";
            
        }
        echo "</form>";
    }
    
    else{
        echo "0 records<br>";
    }
}



?>
</body>
</html>