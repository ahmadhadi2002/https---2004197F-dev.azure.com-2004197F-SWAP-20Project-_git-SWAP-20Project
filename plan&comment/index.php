<html>
<center>
<form action="/project/plan&comment/create.php" method="post">
  <label for="start">Start Date:</label>
  <input type="date" id="startdate" name="startdate">
    <label for="end">End Date:</label>
    <input type="date" id="enddate" name="enddate">
  <label for="item">Item:</label>
  <input id="item" name="item">
  <input type="submit" value="Submit">
</form>
</center>

<?php
session_start();

include 'config.php';
$query=$con->prepare("select * from planner");
$query->execute();
$query->bind_result($startDate, $endDate, $Item, $id);

echo "<table align='center' border='1'><tr>";
echo
"<th>Start Date</th><th>End Date</th><th>Item</th><th>Actions</th></tr>";
while($query->fetch())
{
    echo "<tr>";
    $id;
    echo "<td>";
    echo $startDate; //coresponding record, column's value and prints it out
    echo "</td>";
    echo "<td>";
    echo $endDate; //coresponding record, column's value and prints it out
    echo "</td>";
    echo "<td>";
    echo $Item;//coresponding record, column's value and prints it out
    echo "</td>";
    echo "<td>";
    echo "<form action='/project/plan&comment/update.php' method='get'>";
    echo "<button id ='update' name='update' value=$id>Update</button>";
    echo "</form>";
    echo "<form action='/project/plan&comment/delete.php' method='post'>";
    echo "<button id='delete' name='delete' value=$id>Delete</button>";
    echo "</form>";
    echo "</td>";
    echo "<td>";
    echo "<form action='/project/plan&comment/getcomments.php' method='post'>";
    echo "<button name='getcomments' value=$id>Comments</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

if (isset($_SESSION['plannerid'])){
    unset($_SESSION['plannerid']);
}

?>
</html>