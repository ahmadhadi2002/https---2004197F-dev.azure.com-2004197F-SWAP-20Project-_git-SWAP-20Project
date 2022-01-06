<html>
<body>
<?php
include 'config.php';
//Error msg for connection//
function printerror($message, $con) {
    echo "<pre>";
    echo "$message<br>";
    if ($con) echo "FAILED: ".mysqli_error($con)."<br>";
    echo "</pre>";
}

//Debugger funtion to show connection to mysqli works//
function printok($message) {
    echo "<pre>";
    echo "$message<br>";
    echo "OK<br>";
    echo "</pre>";
}

//establishing connection with database


?>

<form action="getcomments.php" method="get">
	<button name="getcomments">Comments</button>
</form>
<br><br>

<form action="project/plan&comment/addcomments.php" method="post">Start Date (e.g 27 November 2021)
	<input type="date" name="start"><br><br>
End Date (e.g 27 November 2021)
	<input type="date" name="end"><br><br>
Username
	<input type="text" name="username"><br><br>
Department
	<input type="text" name="department"><br><br>
Comment
	<input type="text" name="comment"><br><br>
<input type="submit" name="addcomments">

</form>

</body>
</html>