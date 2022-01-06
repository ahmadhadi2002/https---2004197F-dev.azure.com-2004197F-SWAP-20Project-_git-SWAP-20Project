<?php
require_once "config.php";
session_start();

if (!isset($_SESSION['user_id'] ) ) {
    header("Location: /project/user/login.php");
} /*else if (!$_SESSION["user_role"]=="admin"){
    header("Location: /project/user/login.php");
}*/
 

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

function printerror($message, $con) {
    echo "<pre>";
    echo "$message<br>";
    if ($con) echo "FAILED: ".mysqli_error($con)."<br>";
    echo "</pre>";
}
function printok($message) {
    echo "<pre>";
    echo "$message<br>";
    echo "OK<br>";
    echo "</pre>";
}

try {
    $con=mysqli_connect($db_hostname,$db_username,$db_password, $db_database);
}
catch (Exception $e) {
    printerror($e->getMessage(),$con);
}
if (!$con) {
    printerror("Connecting to $db_hostname", $con);
    die();
}
else printok("Connecting to $db_hostname");

$query="SELECT ID, name, address, email, contact, role, department FROM user";
$result = $con->query($query);
$nrows = $result->num_rows;

if ($nrows > 0){ ?>
    <!-- HTML Page -->
    <!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script charset="utf-8" src="js/app.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
        <h1>Admin user management</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Create new user
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Register new user form -->
                
                <form role="form" method="post" id="registerform" action="/project/projectdelon/create_user.php">
                	<div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="name" placeholder="John Doe" required>
                    </div>
                  	</div>
                
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <small id="passwordHelpBlock" class="form-text text-muted">
					Password must contain at least one uppercase and lowercase letter, one number and 8-20 characters in total                	
					</small>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Securewebapp123!" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
                      title = "Must contain at least one uppercase and lowercase letter, one number and 8-20 characters in total">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Blk 94 Geylang Bahru #12-3110 330094" required>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="email" placeholder="user@company.com" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputContact" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputContact" name="contact" placeholder="81019070" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputRole" name="role" placeholder="Admin" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputDepartment" class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputDepartment" name="department" placeholder="IT" required>
                    </div>
                  </div>
    			</form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <!--             <button type="button" class="btn btn-primary">Save changes</button> -->
                     <input type="submit" form="registerform" value="Create user" name="submit" class="btn btn-primary"/>
                    
              </div>
            </div>
          </div>
        </div>   
	
    <!-- End of HTML Page -->
    <?php
    echo "<table border=1>";
    $columns = "<th>ID</th>";
    $columns .= "<th>Name</th>";
    $columns .= "<th>Address</th>";
    $columns .= "<th>Email</th>";
    $columns .= "<th>Contact</th>";
    $columns .= "<th>Role</th>";
    $columns .= "<th>Department</th>";
    $columns .= "<th>Actions</th>";
    echo "<tr>" . $columns . "</tr>";
    //output data of each row using fetch_assoc()
    while ($row=$result->fetch_assoc()){
        
        $id = (int)$row["ID"];
        $name = $row["name"];
        echo "<tr class='user_row' data-id=$id>";
        foreach($row as $value){
            echo "<td>$value</td>";
        }
        echo "<td><img src='/project/projectdelon/icons/icons8-edit-24.png' class='edit' data-id=$id></td>";
        echo "<td><img src='/project/projectdelon/icons/icons8-delete-24.png' class='delete' data-id=$id></td>";
        echo "</tr>";
    }
    echo "</div>";
}
else{
    echo "0 results retrieved.";
}
$con->close();
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>


<script type="text/javascript">
(function($) {
    $(document).on('click', '.user_row img.edit', function() {
        var _id = parseInt($(this).attr('data-id'));
        var _row = $(this).parent().parent();
        var url = `/project/projectdelon/edit_user.php?id=${_id}`;
        window.location = url;
    });
})(jQuery);

(function($) {
    $(document).on('click', '.user_row img.delete', function() {
        var _id = parseInt($(this).attr('data-id'));
        var _row = $(this).parent().parent();
        if (confirm(`Are you sure you want to delete user ${_id}`))
        {
        /*Asynchronous POST request to delete*/
    		$.ajax({
                url: 'delete_user.php',
                data: {
                    ID: _id
                },
                type: 'POST',
                dataType: 'json',
                success: function(__resp) {
                    if (__resp.success) {
                        _row.remove(); // Deletes the row from the table upon successful delete (response) received
                    }
                }
            });
    	}
    	
    });
})(jQuery);
</script>
</body>
</html>