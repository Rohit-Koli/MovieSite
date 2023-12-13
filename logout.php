<?php 

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location:login.php");
    exit;
}
else {
    session_unset();//Destroy all the asigned variable data
    session_destroy();//Destroy / stop the session
    echo "<script>alert('You are Log Out Now !');</script>";
    header('location:index.php');
}

?>