<?php
$id="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-window">
        <h1>
            Login
        </h1>
        <form action="" method="post">
            <center>
                <input type="email" name="email" id="email" placeholder="Enter Registered Email*" required>
                <!-- <input type="email" name="" id=""> -->
                <input type="password" name="pass" id="pass" placeholder="Enter Password*" required>
                <button type="submit" class="f-btn" onclick="sub()">Submit</button>
                <button type="reset" class="f-btn" onclick="res()">Reset</button><br>
            <em>Want To Create an Account ?<a href="registration.php" class="btn-reg-sign">REGISTER</a></em>

            </center>
        </form>
    </div>
    <?php
    $login = false;
    $ShowError = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        include('_dbconnect.php');
        $conn = mysqli_connect($servername, $username, $password, $database);
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        if (!$conn) {
            die("Fail TO Connect with Database ! Due to this Error" . mysqli_connect_error());
        } else {
            // Inseating Data to Database
            // $sql="INSERT INTO `userdb` (`name`, `email`, `mobile_no`, `password`, `dt`) VALUES ('$name', '$email', '$mno', '$pass', current_timestamp());";
            $sql = "Select * from user where mail='$email' AND password='$pass'";
            $res = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($res);
            if ($num == 1) {
                $login = true;
                session_start();
                $records=mysqli_fetch_assoc($res);
                $u_data=array($records['uname'],$records['mail'],$records['password']);
                $id=$u_data['1'];
                $_SESSION['loggedin'] = true;
                $_SESSION['u_data'] = $u_data;
                $_SESSION['id']=$id;
            } else {
                $ShowError = "Invalid Login Credentials !";
                echo "<script>alert('$ShowError')</script>";
            }
        }
    }

    ?>
    <?php
    if ($login == true) {
        header("location:profile.php");
    }
    ?>
</body>
</html>