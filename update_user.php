<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location:login.php");
    exit();
}

?>
<?php
if (isset($_SESSION['id'])) {
    $id=$_SESSION['id'];
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update User</title>
</head>
<body>
<?php
        include '_dbconnect.php';
        // $id=$_GET['edit'];
        if ($id) {
            $sql = "SELECT * FROM `user` WHERE mail='$id'";
            $showData = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_assoc($showData)) {
                echo '
                <center>
                <form action="update_user.php" method="post">
            <label for="uname">Enter UserName*</label><br>
            <input type="text" name="uname" id="uname" value="' . $rows['uname'] . '" placeholder="Enter Username*" style="width:55%;" required><br>
            <label for="email">Enter Email*</label><br>
            <input type="email" name="email" id="email " value="' . $rows['mail'] . '" placeholder="Enter Email ID *" style="width:55%;" required><br><br>
            <label for="pass">Enter Password*"</label><br>
            <input type="password" name="pass" id="pass" placeholder="" value="' . $rows['password'] . '" style="width:55%;" required><br></center>';
        
        } 
        
    }else {
        echo"<script>alert('Error 1');</script>";
    }
        ?><center>
        <button type="submit" class="f-btn" id="submit-btn" onclick="">Submit</button>
        <a href="profile.php" class="f-btn">Cancel</a>
</form>
        <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // $name = $_POST['name'];
                        // $edit = $_POST['edit'];

                        $uname = $_POST['uname'];
                        $mno = $_POST['mobile'];
                        $email = $_POST['email'];
                        $pass = $_POST['pass'];
                        $query = "UPDATE user SET uname='$uname', mail='$email',password='$pass' WHERE `user`.`mail`='$id'";
                        $query_run = mysqli_query($conn, $query);
                        if ($query_run) {
                            $id=$email;
                            $_SESSION['id']=$id;

                            echo "<script>window.location.href='profile.php';</script>";
                            header('location:profile.php');
                        } else {
                            echo "<script>alert('Fail To Update Data !');</script>";
                        }
                    }
        ?>
</body>
</html>