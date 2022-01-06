<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<h1>INSERT NEW ANNOUNCEMENT</h1>

<form action="/project/announcement/function/add_announcement.php" method="post">
DETAILS <br>
  Name:<input type="text"  name="name" value="<?php echo $_SESSION['user_name']; ?>" disabled> &emsp;
  
  Role:<input type="text"  name="role"  value="<?php echo $_SESSION['user_role']; ?>" disabled>&emsp;
  
  Department:<input type="text" value="<?php echo  $_SESSION['user_department']; ?>" name="department" disabled><br><br>
  
DATES<br>
  Start:
  <input type="date"  name="start"  >
  
  &emsp; 
  End:<input type="date"  name="end"  ><br><br>
 
  Announcement:<br><textarea  name="task" rows="4" cols="50"></textarea><br><br>


  <input type="submit" value="SUbmit" >
</form>


</body>
</html>

