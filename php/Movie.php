<?php 
    class Movie
    {
        public function __construct(){
        }
     
        public function getCard($movie)
        {
            $title = $movie['Title']."(".$movie['Year'].")";
            $str = '<div class="card mb-3" style="max-width: 70%;">
            <div class="row no-gutters bg-dark">
              <div class="col-md-4" style="max-width: 100px">
                <img src="'.$movie['Poster'].'" class="card-img" alt="'.$title.'">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">'.$movie['Title'].'</h5>
                  <p class="card-text">Año: '.$movie['Year'].'</p>
                </div>
              </div>
              <a class="btn btn-warning sa_button" href="movie.php?id='.$movie['imdbID'].'">Conocer más</a>
            </div>
          </div>';
          return $str;
        }
    }
?>