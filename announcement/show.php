<html>
<body>


<h3 style="color: #ffffff; background-color: #000000; text-align: center; margin: 0px; padding: 0px;">Announcements DATABASE</h3>

<table >
<style>
table { id=1 font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
td, th {border: 1px solid #dddddd;text-align: left;padding: 8px;}

</style>
 <tr>
	<th>
    	 <form action="/project/announcement/filter.php" method='POST'>
         <label for="dep">Department's Announcement:</label>
         <select name="filter" >
         <option value=""></option>
         <option value="IT">IT</option>
         <option value="HR">HR</option>
    	 <option value="Testing">Testing</option>
    	 </select>
         <input type="submit" value="Submit"></form>
	 </th>
	 
	 <th><textarea name=id disabled; textarea rows=4 cols=50 style=display:none></textarea>
	 </th>``
	 <th>
	 Add new announcement: 
        <form method="post" action="http://localhost/project/announcement/insert.php">
        <button type="submit">Submit</button>
        
        </form>
	 </th>
 </tr>
</table>
<br>
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
    $nrows=$result->num_rows;
    echo "number of announcement = $nrows<br>";
    
    if ($nrows>0){
        echo "<table border=1; align='center'>";
        echo "<tr>";
        echo "<th>ID</th><th>Announcement</th><th>Action</th>";
        
        
        while($row=$result->fetch_assoc()){
            echo "<tr>";
            
            echo "<td>";
            echo $row['ID'];
            echo "</td>";
            
            $ID=$row['ID'];
            $role=$row['ROLE'];
            $name=$row['NAME'];
            $role=$row['ROLE'];
            $department=$row['DEPARTMENT'];
            $start=$row['START'];
            $end=$row['END'];
            $task=$row['TASK'];
            
            echo "<td>";
            echo "DETAILS <br>";
            echo "Name: $name <br>" ;
            echo "&nbsp; Role: $role " ;
            echo "&nbsp; Department: $department  <br> <br>" ;
            echo "DATE <br>";
            echo "Start: $start  " ;
            echo "&emsp;End: $end  <br> <br>" ;
            echo "Announcement: $task<br><br>";
            echo "</td>";
            

            echo"<th>";
            echo "<form action='/project/announcement/delete.php' method='post'>";
            echo "<button input=submit; name='delete' value=$ID>Delete</button>";
            echo "</form>";

            echo "<form action='/project/announcement/insertUpdate.php' method='post'>";
            echo "<button input=submit; name='update' value=$ID>Edit</button>";
            echo "</form>";
            echo"</th>";

 
 
            
            echo "</tr>";
        }
        echo "</table>";
    }
    
    else{
        echo "0 records<br>";
    }
}



?>
<br> <br>

    
</form>

 Click here for <a href="http://localhost/project/announcement/view.php">Non-privilege user view</a>

</body>
</html>