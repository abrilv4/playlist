let autoplay = 0;
let indice = 0;
let Playing_song = false;
var canciones = array;
// play song
function playsong(){
    Playing_song = true;
    play.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
  }
  
  //pause song
  function pausesong(){
      Playing_song = false;
      play.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
  }
// next song
function next_song(canciones){
	if(indice < canciones.length - 1){
		indice += 1;
		playsong();
	}else{
		indice = 0;
		playsong();

	}
}

// previous song
function previous_song(canciones){
	if(indice > 0){
		indice -= 1;
		playsong();

	}else{
		indice = canciones.length;
		playsong();
	}
}