<html>
<body>

<?php 
session_start();
$con = mysqli_connect("localhost","root","","project"); //connect to database
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}


$query=$con->prepare("SELECT ID,NAME,ROLE,DEPARTMENT,TASK,START,END FROM announcement WHERE DEPARTMENT = ?");
$sess_dep = $_SESSION['user_department'];
$query->bind_param('s', $sess_dep); //bind the parameters
echo "<div class='img-rounded' style='float: left; background-color: ##FFFFFF; width: 800px; height: 550px; border: 1px solid black; margin: 0px;'>
                    <h3 style='color: #ffffff; background-color: #000000; text-align: center; margin: 0px; padding: 0px;'> Announcements (Department: $sess_dep) </h3><br>";

$result=$query->execute();
$result=$query->get_result();

if(!$result){
    die("SELECT query failed<br>".$con->error);
}
else{
    $nrows=$result->num_rows;
    if ($nrows>0){
        while($row=$result->fetch_assoc()){
            $dep=$row['DEPARTMENT'];
            $name=$row['NAME'];
            $role=$row['ROLE'];
            $department=$row['DEPARTMENT'];
            $start=$row['START'];
            $end=$row['END'];
            $task=$row['TASK'];
            


            //echo "<input type=text; name=id; value=$id; disabled; style=display:none> <br>";
            echo "Name: <input type=text value=$name readonly><br>" ;
            echo "&nbsp; Role: <input type=text value=$role readonly > <br> <br>" ;
            echo "Start: <input type=date value=$start name=start readonly> " ;
            echo "&emsp;";
            echo "End: <input type=date value=$end name=end readonly> <br>" ;
            echo "Announcement: <textarea rows=4 cols=50 name=task readonly> $task</textarea><br><br>";         
        }      
    }
    
    else{
        echo "0 records<br>";
    }
}

?>
<div id="page" style="height: 320px; overflow-x: hidden; overflow-y: auto; padding: 6px; text-align: left;"></div>

</body>
</html>