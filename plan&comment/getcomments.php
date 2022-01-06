<html>
<body> 

<form action="addcomments.php" method="post">
    <div>
        Add Comments <br>
	    <textarea class='commentarea' name="comment" rows= '4' cols='50' style="font:arial" placeholder="Comment"></textarea>    
        <br><br>
    </div>
    <input type="submit" class="addbutton" name="addcomments">
</form>



<?php
include 'config.php';
session_start();

if (!isset($_SESSION['plannerid'])){
    $id = $_POST['getcomments'];
    $_SESSION['plannerid'] = $id;
}
else{
    $id = $_SESSION['plannerid'];
}


$query=$con->prepare("SELECT `Start Date`, `End Date` FROM `planner` WHERE `id` =?");
$query->bind_param("s",$id);
$query->execute();
$query->bind_result($startDate, $endDate);

while ($query->fetch()){
    $start=$startDate;
    $end=$endDate;
}


if (!empty($id)){
    
    $query = $con->prepare("SELECT * FROM `comments` WHERE START=? && END=?");
    $query->bind_param('ss',$start,$end);
    if ($query->execute()){
        echo "Query executed. Comments received<br>";
        $query->bind_result($id, $start, $end, $username, $department, $comment, $timestamp, $plannerid);
        
    }else{
        echo "Error executing query.";
    }
    
    echo "==============Comments==================<br><br>";
    
    while ($query->fetch()){

        echo "<div id='commentbox'>";
        echo "<div class='side'>";
        echo "<div style='background-color: white; padding: 0px; width:max-content; border-style:none; border-radius: 5px'>";
        echo "<div class='idinfo'>";
        echo "ID:".$id."<br>";
        echo "Username:".$username."<br>";
        echo "</div>";
        echo "</div>";
        echo "<div class='department'>";
        echo "<div class='departmenttop'>Department</div><nobr>";
        echo "<div class='departmentinfo'>".$department."</div>";
        echo "</div>";
        echo "</div>";
        echo "<br>";
        echo "<div class='commenttop'>";
        echo "Comment<br></div>";
        echo "<div class= 'comment'>";
        echo $comment;
        echo "</div>";
        echo "<br>";
        echo "<div class='timestamp'>";
        echo "Timestamp: ".$timestamp;
        echo "</div>";
        echo "</div>";
        echo "</div>";
       
        //making of update and delete buttons//

        //if ($_SESSION['username'] == $username){
        echo "<div class='side'>";
        echo "<form action='/project/plan&comment/updatecomment.php' method='post'>";
        echo "<button id='updatecomment' name='updatecomment' class='updatebutton' value=$id>Update</button>";
        echo "</form><nobr>";
        echo "<form action='/project/plan&comment/deletecomment.php' method='post'>";
        echo "<button id='deletecomment' name='deletecomment' class='deletebutton' value=$id onclick='return clicked();'>Delete</button></form>";
        echo "</div>";
        echo "<br><br>";
        //}
    }
}
?>


<!-- Script stuffs -->

<script type="text/javascript">
    function clicked() {
       if (confirm('Are you sure you want to Delete?')) {
           yourformelement.submit();
       } else {
           return false;
       }
    }
</script>

<!-- CSS -->
<style>
    body{
        background-color: white;
    }

    [type='submit'].addbutton {
        border-radius: 25px;
        background-color: lightgray;
        padding: 5px;
        height: 30px;
        width: 80px;
        border-style: none;
        
    }
    .updatebutton {
        border-radius: 25px;
        background-color: #24bd45;
        color: white;
        padding: 5px;
        height: 30px;
        width: 80px;
        border-style: none;
        position: absolute;
        margin-top: 10px;
        
    }
    .deletebutton {
        border-radius: 25px;
        background-color: #a3373b;
        color: white;
        padding: 5px;
        height: 30px;
        width: 80px;
        border-style: none;
        position: absolute;
        left: 100px;
        margin-top: 10px;
    }

    .commentarea{
        margin-top: 5px;
        font-family: Arial, Helvetica, sans-serif;
        border: 3px solid #f1f1f1

    }

    .side{
        display: flex;
    }

    .idinfo{
        width: 100px;
        
    }

    .department{
        position: relative;
        margin-left: 215px;
    }

    .departmenttop{
        font-weight: bold;
    }

    .departmentinfo{
        position: relative;
        margin-left:60px;
    }

    #commentbox{
        background-color: white;
        padding: 2px;
        border: 2px solid #757575;
        border-radius: 2px;
        width: 400px;
    }

    .comment{
        border: 1px solid #757575;
        background-color: #e0e0e0;
        padding: 5px;
        min-height: 70px;
        width: 385px;
        height: max-content;
        word-break: break-all;
    
    }

    .commenttop{
        font-size: 18px;
        font-weight: bold;
    }

    .timestamp{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12;
        opacity: 70%;
    }

</style>



</body>
</html>