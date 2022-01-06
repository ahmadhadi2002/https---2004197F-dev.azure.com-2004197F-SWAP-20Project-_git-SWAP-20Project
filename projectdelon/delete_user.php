<?php
require_once 'check_input.php';
session_start();
/*
 echo "<pre><b>For authorised administrators only</b><br></pre>";
 
 if (isset($_SESSION["user_id"]) && $_SESSION["user_role"]=="admin"){
  all code to be placed here later
  //manager cannot delete user account
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
function delete_user($id){
    require "config.php";
//     function printerror($message, $con) {
//         echo "<pre>";
//         echo "$message<br>";
//         if ($con) echo "FAILED: ". mysqli_error($con). "<br>";
//         echo "</pre>";
//     }
    
//     function printok($message) {
//         echo "<pre>";
//         echo "$message<br>";
//         echo "OK<br>";
//         echo "</pre>";
//     }
    try {
        $con=mysqli_connect($db_hostname,$db_username,$db_password);
    }
    catch (Exception $e) {
//         printerror($e->getMessage(),$con);
    }
//     if (!$con) {
//         printerror("Connecting to $db_hostname", $con);
//         die();
//     }
//     else printok("Connecting to $db_hostname");
    
    $result=mysqli_select_db($con, $db_database);
//     if (!$result) {
//         printerror("Selecting $db_database",$con);
//         die();
//     }
//     else printok("Selecting $db_database");
    
    
    $query="DELETE FROM user WHERE ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    //$affected_rows = $stmt->affected_rows;
//     if (!$result) {
//         printerror("Selecting $db_database",$con);
//         die();
//     }
//     else printok($query);
//     printok("Affected Rows: $affected_rows");
    global $success;
    $success = true;
    header('Content-Type: application/json');
    echo json_encode(array('success' => $success));
    $stmt->close();
    $con->close();
    //printok("Closing connection");
}
// $is_int = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);

$_POST['ID'] = (int)$_POST['ID'];
$valid = check_input("ID", true, "/^[0-9]+$/"); // check id only contains one or more numbers

$id = $_POST['ID'];
$success = false;
if (!$valid){
    echo "Input is invalid<br>Please return to the manage users page";
    die();
}
delete_user($id);


?>