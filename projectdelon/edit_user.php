<?php
require_once 'check_input.php';
session_start();
function printerror($message, $con) {
    echo "<pre>";
    echo "$message<br>";
    if ($con) echo "FAILED: ". mysqli_error($con). "<br>";
    echo "</pre>";
}
/*
 echo "<pre><b>For authorised administrators only</b><br></pre>";
 
 if (isset($_SESSION["user_id"]) && $_SESSION["user_role"]=="admin"){
 all code to be placed here later
 }
 elseif (!isset($_SESSION["username"]))
 {
 echo "<pre><h3><a href=loginform.php>You have not logged in. Please go back to login page</a></h3></pre>";
 debug();
 die("");
 }
 else {
 echo "<pre><h3><a href=loginform.php>You have not logged in as an administrator. This page is only for authorised administrators</a></h3></pre>";
 debug();
 die("");
 }
 */
#header('Content-Type: application/json');
function printmessage($message) {
    // echo "<script>console.log(\"$message\");</script>";
    echo "<pre>$message<br></pre>";
}

// return true if checks ok
function checkpost($input, $mandatory, $pattern) {
    
    $inputvalue=$_POST[$input];
    
    if (empty($inputvalue)) {
        printmessage("$input field is empty");
        if ($mandatory) return false;
        else printmessage("but $input is not mandatory");
    }
    if (strlen($pattern) > 0) {
        $ismatch=preg_match($pattern,$inputvalue);
        if (!$ismatch || $ismatch==0) {
            printmessage("$input field wrong format <br>");
            if ($mandatory) return false;
        }
    }
    return true;
}
//function edit_user($role, $department, $id) -backup
function edit_user($name, $password, $address, $email, $contact, $role, $department, $id){
    require "config.php";
    try {
        $con=mysqli_connect($db_hostname,$db_username,$db_password);
    }
    catch (Exception $e) {
        printerror($e->getMessage(),$con);
    }
    $result=mysqli_select_db($con, $db_database);
    if (!$result) {
        die("Error selecting $db_database" . $con->error);
    }
    //$query="UPDATE user SET name = ?, address = ?, email = ?, contact = ?, role = ?, department = ? WHERE ID = ?"; #no password
    $query="UPDATE user SET name = ?, password = ?, address = ?,  contact = ?, role = ?, department = ? WHERE ID = ?";
    //$query="UPDATE user SET role = ?, department = ? WHERE ID = ?";
    if ($stmt = $con->prepare($query)){
        //$stmt->bind_param("ssi", $role, $department, $id);
        //     $stmt->bind_param("sssssi", $name, $address, $email, $role, $department, $id);
        $stmt->bind_param("ssssssi", $name, $password, $address,  $contact, $role, $department, $id);
        $status = $stmt->execute();
    }else{
        die("Error in prepared statement." . $con->error);
    }
    if (!$status) {
        die("execute() failed." . $stmt->error);
    }
    $affected_rows = $stmt->affected_rows;
    echo "Row updated: " . $affected_rows;
    $stmt->close();
    $con->close(); 
    header('Location: http://localhost/project/projectdelon/manage_users_new.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    function str($val) {
        if (!is_string($val)) {
            global $valid;
            $valid = false;
            return;
        }
        $val = trim(htmlspecialchars($val));
        return $val;
    }
    $valid = true;
    //$valid = $valid && isNotFullyEmpty($_POST);
    //$valid = $valid && !isEmpty($_POST);
    $valid=$valid && checkpost("name",true,"");
    // Password must contain at least one uppercase and lowercase letter, one number and 8-20 characters in total
    $valid=$valid && checkpost("password",true,"/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}/");
    $valid=$valid && checkpost("address",true,"");
    //$valid=$valid && checkpost("email",true, "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i");
    // i behind the pattern is for case insensitive
    $valid = $valid && check_input("role", true, "");
    $valid = $valid && check_input("department", true, "");
    if (!$valid){
        echo "Input do not meet requirements. Please fill in all details";
    }
    
    // $_POST['ID'] = (int)$_POST['ID'];
    // $valid = $valid && check_input("ID", true, "/^[0-9]+$/"); // check id only contains one or more numbers
    
    $id = $_POST['ID'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false){
        die("Invalid ID");
    }
    if (!$valid){
        echo "Input is invalid<br>Please return to the edit user page";
        die();
    }
    $name=$_POST['name'];
    $password=md5($_POST['password']);
    $address=$_POST['address'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $role=$_POST['role'];
    $department=$_POST['department'];
    //edit_user($role, $department, $id);
    edit_user($name, $password, $address, $email, $contact, $role, $department, $id);
    
} 
else if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
    require "config.php";
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false){
        die("Invalid ID");
    }
    try {
        $con=mysqli_connect($db_hostname,$db_username,$db_password);
    }
    catch (Exception $e) {
        printerror($e->getMessage(),$con);
        die("Connection failed");
    }
    $result=mysqli_select_db($con, $db_database);
    if (!$result) {
        printerror("Selecting $db_database",$con);
        die();
    }
    $query="SELECT name, address, email, contact, role, department FROM user WHERE ID = ?";
    if($stmt = $con->prepare($query)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        // any additional code you need would go here.
    } else {
        $error = $con->errno . ' ' . $con->error;
        echo $error; // 1054 Unknown column 'foo' in 'field list'
    }
    if (!$result){
        die(mysqli_error($con));
    }
    $result=$stmt->get_result();
    $row=$result->fetch_assoc();
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Edit User</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script charset="utf-8" src="js/app.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </head>
	<body>
    	<div class="container">
            <form action="edit_user.php" id="edit_form" method="post">
            	User ID: <input type="text" name='ID' value="<?php echo $id;?>" readonly><br>
            	<div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $row['name'];?>" required>
                        </div>
                </div>
                <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <small id="passwordHelpBlock" class="form-text text-muted">
					Password must contain at least one uppercase and lowercase letter, one number and 8-20 characters in total                	
					</small>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputPassword" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}">
                        </div>
                </div>
                <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputAddress" name="address" value="<?php echo $row['address'];?>" required>
                        </div>
                </div>
                <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label" >Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $row['email'];?>" disabled>
                        </div>
                </div>
                 <div class="form-group row">
                        <label for="inputContact" class="col-sm-2 col-form-label">Contact Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputContact" name="contact" value="<?php echo $row['contact'];?>" required>
                        </div>
                 </div>
                 <div class="form-group row">
                        <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputRole" name="role" value="<?php echo $row['role'];?>" required>
                        </div>
                 </div>
                 <div class="form-group row">
                        <label for="inputDepartment" class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputDepartment" name="department" value="<?php echo $row['department'];?>" required>
                        </div>
                  </div>
                  <input type="submit" form="edit_form" value="Update user" name="submit" class="btn btn-primary"/>
            </form>
        </div>
    </body>
    </html>
   <?php 
    
    
}

?>