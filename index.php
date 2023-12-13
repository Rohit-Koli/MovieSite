<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
        const response = await fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', options);
        const data = await response.json();
        return data.results; 
      } catch (error) {
        console.error('Error:', error);
      }
    }

    async function displayDataOneByOne() {
      const dataContainer = document.getElementById('dataContainer');
      const apiData = await fetchData();

      if (apiData) {
        for (const movie of apiData) {
          const movieContainer = document.createElement('div');
          movieContainer.classList.add('movie-item'); 

          const titleElement = document.createElement('h2');
          titleElement.textContent = movie.title; 

          const overviewElement = document.createElement('p');
          overviewElement.textContent = movie.overview;

          const ReleaseDate = document.createElement('p');
          ReleaseDate.textContent = movie.release_date;

          const posterElement = document.createElement('img');
          posterElement.classList.add('movie-poster');
          posterElement.src = `https://image.tmdb.org/t/p/w500${movie.poster_path}`; 
          
          movieContainer.appendChild(titleElement);
          movieContainer.appendChild(overviewElement);
          movieContainer.appendChild(posterElement);
          movieContainer.appendChild(ReleaseDate);

          dataContainer.appendChild(movieContainer);

          await new Promise(resolve => setTimeout(resolve, 100)); 
        }
      }
    }

    displayDataOneByOne();
  </script>
  <script src="script.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
