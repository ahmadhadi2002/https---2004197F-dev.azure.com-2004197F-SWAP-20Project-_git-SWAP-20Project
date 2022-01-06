<?php

include 'config.php';

session_start();

error_reporting(0);

if(isset($_POST['submit'])) {
    
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $cfmpassword = mysqli_real_escape_string($conn, md5($_POST["cfmpassword"]));
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    $token = md5(rand());
    
    
    
    
    if ($password == $cfmpassword) {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            
            $sql = "INSERT INTO user (name, email, password, address, contact, token, status) VALUES ('$name', '$email', '$password', '$address', '$contact', '$token', '0')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_POST["name"] = "";
                $_POST["email"] = "";
                $_POST["password"] = "";
                $_POST["cfmpassword"] = "";
                $_POST["address"] = "";
                $_POST["contact"] = "";
                
                $to = $email;
                $subject = "Email Verification";
                
                $message = "
                <html>
                <head>
                <title>Email</title>
                </head>
                <body>
                <p><strong>Dear {$name}, </strong></p>
                <p>Please Click The Link Below To Verify Your Email.</p>
                <p><a href='{$base_url}verify-email.php?token={$token}'>Verify Email</a></p>
                
                </body>
                </html>
                ";
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= "From: ". $myemail;
                
                if (mail($to,$subject,$message,$headers)) {
                    echo "<script>alert('We have sent a verification link to your email - {$email}.');</script>";
                } else {
                    echo "<script>alert('Mail not sent, please try again')</script>";
                }
                
            } else {
                echo "<script>alert('Something went wrong')</script>";
            }
            
        } else {
            echo "<script>alert('Email already has an account registered to it')</script>";
        }
        
    } else {
        echo "<script>alert('Password is not the same as Confirm Password')</script>";
    }
    
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Registers Form</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
           <p class="login text" style="font-sizr: 2rem; font-weight: 800;">Register</p>
           <div class="input-group">
           	<input type="text" placeholder="Full Name" name="name" value="<?php echo $name; ?>" required>
           </div>
           <div class="input-group">
           	<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
           </div>
           <div class="input-group">
           	<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
           </div>
           <div class="input-group">
           	<input type="password" placeholder="Confirm Password" name="cfmpassword" value="<?php echo $_POST['cfmpassword']; ?>" required>
           </div>
           <div class="input-group">
           	<input type="text" placeholder="Address" name="address" value="<?php echo $address; ?>" required>
           </div>
           <div class="input-group">
           	<input type="tel" placeholder="Phone Number" name="contact" value="<?php echo $contact; ?>" required>
           </div>
           <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
        </form>
    </div>
</body>
</html>