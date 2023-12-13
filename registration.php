<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistrationPage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="fname">
        <h2 class="fh3">Welcome To Registration Form Of Royal Gym</h2>
    </div>
    <form action="registration.php" method="post">
        <center>
            <input type="text" name="name" id="name" placeholder="Enter Your Name*" required><br>
            <input type="email" name="email" id="email "placeholder="Enter Email ID *" required><br>
            <input type="password" name="pass" id="pass"placeholder="Enter Password*"  required><br>    
            <button type="submit" class="f-btn" id="submit-btn" onclick="">Submit</button>
            <button type="reset" class="f-btn">Reset</button><br>
            <em>Already Have an Account ?<a href="login.php" class="btn-reg-sign">SIGN IN</a></em>
            
        </center>        
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            include ('_dbconnect.php');
            
            $name=$_POST['name'];
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            $existSql="SELECT * FROM `user` WHERE uname='$email';";
            $result=mysqli_query($conn,$existSql);
            $numExistRows=mysqli_num_rows($result);
            if($numExistRows > 0){
                $ShowError="Email Already Exist";
                echo "<script>alert('$ShowError');</script>";
            }
            else{
                
                // $sql="INSERT INTO `user` (`name`, `uname`, `email`, `mobile_no`, `password`, `dt`) VALUES ('$name', '$uname', '$email', '$mno', '$pass', current_timestamp());";
                // $sql="INSERT INTO `user` (`name`, `uname`, `email`, `mobile_no`, `password`, `dt`) VALUES ('$name', '$uname', '$email', '$mno', '$pass', current_timestamp());";
                $sql="INSERT INTO `user` (`uname`, `mail`, `password`, `registration_date`) VALUES ('$name', '$email', '$pass', current_timestamp());";
                $res=mysqli_query($conn,$sql);
                if ($res) {
                    echo "<script>
                    alert('Registrition is Completed ');
                    </script>";
                }
                if($res){
                    header("location:profile.php");
                }
            }
            
        }
    ?>
</body>
</html>