var mvname="";
    function processInput() {
      // Get user input
      var userInput = document.getElementById('userInput').value;

      // Replace spaces with "%20"
      var mvname = userInput.replace(/ /g, "%20");
    MovieSearch(mvname)
    }
function MovieSearch(mvname){
    fetch('https://imdb8.p.rapidapi.com/auto-complete?q='+mvname,{
	"method": "GET",
	"headers":{
		'X-RapidAPI-Key': 'eaf7e6b7a9msh36e4405a34d08bdp197561jsnfa9b6d12ed54',
		'X-RapidAPI-Host': 'imdb8.p.rapidapi.com'
	}
})
.then(response=>response.json())
.then(data=>{
	const list=data.d;

	list.map (item => {
		const name=item.l;
		const poster=item.i.imageUrl;
		const ry=item.y;
		const cast=item.s;
		const mo=`
		<div class="card">
  			<h5 class="card-header">${name}</h5>
 			<div class="card-body">
			 	<img src="${poster}"height="250px" width="250px">
    			<p class="card-text">${cast}</p>
    			<p class="card-text">${ry}</p>
  			</div>
		</div>`
		document.querySelector('.mv').innerHTML+=mo;
	})
})
}
function movie(){
	const options = {
		method: 'GET',
		headers: {
		  accept: 'application/json',
		  Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhN2MwNWY2ZmNhZjc3NDFkMGUzYWFhMWZmMjBjY2IwMSIsInN1YiI6IjY1NzUyNzJjZTkzZTk1MDExZDRlNTE0MyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.wZHIZbGns0YV8cmV18_6soCeXjvMJIP7njw6sCnzUD8'
		}
	  };
	  
	  fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', options)
		.then(response => response.json())
		.then(response => console.log(response))
		.catch(err => console.error(err));
}
