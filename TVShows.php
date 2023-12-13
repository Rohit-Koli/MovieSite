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
    <title>TV Shows</title>
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
          
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="userInput">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="processInput()">Search</button> -->
            <!-- <label for="userInput">Enter Movie / Series Name :</label> -->
            <div class="search-bar">
              <input type="text" id="userInput" placeholder="Search Movie/Series">
              <button onclick="processInput()">Search</button> 
            </div>          
        </div>
    </div>
      </nav>
    
    <div class="movieSearch"> 
          <div class="mv">
          
          </div>
      </div>  
    <div id="dataContainer">
  
    </div>
  <?php include'footer.php'?>

    <script>
        const options = {
        method: 'GET',
        headers: {
        accept: 'application/json',
        Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhN2MwNWY2ZmNhZjc3NDFkMGUzYWFhMWZmMjBjY2IwMSIsInN1YiI6IjY1NzUyNzJjZTkzZTk1MDExZDRlNTE0MyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.wZHIZbGns0YV8cmV18_6soCeXjvMJIP7njw6sCnzUD8'
        }
    };
    async function fetchData() {
          try {
            // const response =await fetch('https://api.themoviedb.org/3/movie/popular?language=en-US&page=1&sort_by=popularity.desc', options)
            const response =await fetch('https://api.themoviedb.org/3/tv/popular?api_key=a7c05f6fcaf7741d0e3aaa1ff20ccb01', options)
            const data = await response.json();
            return data.results; // Assuming 'results' is an array of movies in the API response
          }catch (error) {
            console.error('Error:', error);
          }
    }
        async function displayDataOneByOne() {
          const dataContainer = document.getElementById('dataContainer');
          const apiData = await fetchData();
    
          if (apiData) {
            for (const movie of apiData) {
              const movieContainer = document.createElement('div');
              movieContainer.classList.add('movie-item'); // Add a class
    
              const titleElement = document.createElement('h2');
              titleElement.textContent = movie.title; // Adjust to display relevant movie data
    
              const overviewElement = document.createElement('p');
              overviewElement.textContent = movie.overview; // Adjust to display relevant movie data
    
              const ReleaseDate = document.createElement('p');
              ReleaseDate.textContent = movie.vote_average; // Adjust to display relevant movie data
    
              const posterElement = document.createElement('img');
              posterElement.classList.add('movie-poster');
              posterElement.src = `https://image.tmdb.org/t/p/w500${movie.poster_path}`; // Assuming 'poster_path' is part of your API response
              
    
              // Append the elements to the movieContainer
              movieContainer.appendChild(titleElement);
              movieContainer.appendChild(overviewElement);
              movieContainer.appendChild(posterElement);
              movieContainer.appendChild(ReleaseDate);
    
              dataContainer.appendChild(movieContainer);
    
              // You can add a delay between each movie if needed
              await new Promise(resolve => setTimeout(resolve, 100)); // Adjust the delay in milliseconds
            }
          }
        }
    
        // Call the function to start displaying data
        displayDataOneByOne();
      </script>
    <script src="script.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>