
<?php
session_start();
/*
 echo "<pre><b>For authorised administrators only</b><br></pre>";
 
 if (isset($_SESSION["user_id"]) && $_SESSION["user_role"]=="admin"){
 
 }
 elseif (!isset($_SESSION["user_id"]))
 {
 echo "<pre><h3><a href=login.php>You have not logged in. Please go back to login page</a></h3></pre>";
 debug();
 die("");
 }
 else {
 echo "<pre><h3><a href=login.php>You have not logged in as an administrator. This page is only for authorised administrators</a></h3></pre>";
 debug();
 die("");
 }
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    function create_user($name, $password, $address, $email, $contact, $role, $department){
        require "config.php";
        
        function printerror($message, $con) {
            echo "<pre>";
            echo "$message<br>";
            if ($con) echo "FAILED: ". mysqli_error($con). "<br>";
            echo "</pre>";
        }
        
        function printok($message) {
            echo "<pre>";
            echo "$message<br>";
            echo "OK<br>";
            echo "</pre>";
        }
        
        try {
            $con=mysqli_connect($db_hostname,$db_username,$db_password);
        }
        catch (Exception $e) {
            printerror($e->getMessage(),$con);
        }
        if (!$con) {
            printerror("Connecting to $db_hostname", $con);
            die();
        }
        else printok("Connecting to $db_hostname");
        
        $result=mysqli_select_db($con, $db_database);
        if (!$result) {
            printerror("Selecting $db_database",$con);
            die();
        }
        else printok("Selecting $db_database");
        
        /*hashing of password in future before insert*/
        $query="INSERT INTO user (name, password, address, email, contact, role, department)
		VALUES ('$name', '$password', '$address', '$email', '$contact', '$role', '$department')";
        $result=mysqli_query($con,$query);
        if (!$result) {
            printerror("Selecting $db_database",$con);
            die();
        }
        else printok($query);
        $_SESSION['user_role'] = $role;
        $_SESSION['user_department'] = $department;
        mysqli_close($con);
        printok("Closing connection");
        //redirect back
        header('Location: http://localhost/project/projectdelon/manage_users_new.php');
    }
    /*Input validation*/
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
    $checkall=true;
    $checkall=$checkall && checkpost("name",true,"");
    // Password must contain at least one uppercase and lowercase letter, one number and 8-20 characters in total
    $checkall=$checkall && checkpost("password",true,"/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}/"); 
    if (!$checkall) {
        printmessage("Password must contain at least one uppercase and lowercase letter, one number and 8-20 characters in total<br>Please return to the registration with roles and department form");
        die();
    }
    $checkall=$checkall && checkpost("address",true,"");
    $checkall=$checkall && checkpost("email",true,
        "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i");
    // i behind the pattern is for case insensitive
    $checkall=$checkall && checkpost("contact",true,"");
    $checkall=$checkall && checkpost("role",true,"");
    $checkall=$checkall && checkpost("department",true,"");
    
    if (!$checkall) {
        printmessage("Error checking inputs<br>Please return to the registration with roles and department form");
        die();
    }
    
    $name=$_POST['name'];
    $password=md5($_POST['password']);
    $address=$_POST['address'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $role=$_POST['role'];
    $department=$_POST['department'];
    create_user($name, $password, $address, $email, $contact, $role, $department);
}
else{
    echo "Wrong request";
}
?>

