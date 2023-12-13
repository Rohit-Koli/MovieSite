<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location:login.php");
    exit();
}
?>
<?php
if (isset($_SESSION['u_data'])) {
    $user = $_SESSION['u_data'];
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
    <title>Profile Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">IMDB.COM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="movies.php">Movies <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="TVShows.php">TV Shows</a>
        </li>
        <li class="nav-item active">
              <a class="nav-link" href="profile.php">Profile</a>
        </li>
      </ul>
        <div class="search-bar">
          <input type="text" id="userInput" placeholder="Search Movie/Series">
          <button onclick="processInput()">Search</button> 
        </div> 
    </div>
  </nav>
  <div class="movieSearch"> 
        <div class="mv">
        
        </div>
    </div>

  <div id="dataContainer">

  </div>
  <div class="user-container">
        <center>
            <?php
            // include'_dbconnect.php';
            $servername="localhost";//Server Name
            $username="root";//User Name
            $password="";//Password
            $database="moviesdb";//Database Name
            $conn=mysqli_connect($servername,$username,$password,$database);
            if (!$conn) {
                // die("Fail TO Connect with Database ! Due to this Error".mysqli_connect_error());
                die("Fail TO Connect with Database ! Due to this Error");
            }
                $sql="SELECT * FROM `user` WHERE mail='$id'";
                $query=mysqli_query($conn,$sql);
                while ($rows=mysqli_fetch_assoc($query)) {
                    echo'<h2>
                    Welcome -'.$rows['uname'].'
                </h2><br>          
            
            <div class="userinfo">
                 <p class="user-details">Your Name is :-'.$rows['uname'].'</p>
                <p class="user-details">Email ID :-'.$rows['mail'].'</p>
                <p class="user-details">Password is :-'.$rows['password'].'</p>
                ';
                }
                ?>             
                


                </p>
               

            </div>
            <a href="logout.php" class="Logout-btn">
                <button class="f-btn">LogOut</button>
            </a>
            <a href="update_user.php" class="Logout-btn">
                <button class="f-btn">Update</button>
            </a>

        </center>
    </div>
  </section>
  <?php include'footer.php'?>

</body>
</html>