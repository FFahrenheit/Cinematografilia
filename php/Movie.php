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
                  <h5 class="card-title text-warning">'.$movie['Title'].'</h5>
                  <p class="card-text text-warning">Año: '.$movie['Year'].'</p>
                </div>
              </div>
              <a class="btn btn-warning sa_button" href="movie.php?id='.$movie['imdbID'].'">Conocer más</a>
            </div>
          </div>';
          return $str;
        }

        public function getNavigator($page, $total,$movie)
        {
            $url = "search.php?title=$movie&page=";
            if($page == 1)
            {
                return '<div class="sa_dark"><nav aria-label="Paginas" >
                <ul class="pagination justify-content-center">
                  <li class="page-item bg-warning text-dark text-muted">
                    <span class="page-link text-muted bg-warning text-dark">Anterior</span>
                  </li>
                  <li class="page-item active bg-warning text-dark">
                  <span class="page-link bg-secondary text-dark">
                  '.$page.'
                  <span class="sr-only">(current)</span>
                </span>
                  </li>
                  <li class="page-item active">
                  <a class="page-link bg-warning text-dark" href="'.$url.($page+1).'">'.($page+1).'</a>

                  </li>
                  <li class="page-item"><a class="page-link bg-warning text-dark" href="'.$url.($page+2).'">'.($page+2).'</a></li>
                  <li class="page-item">
                    <a class="page-link bg-warning text-dark" href="'.$url.($page+1).'">Siguiente</a>
                  </li>
                </ul>
              </nav></div>';
            }
            else if($page*10 >= $total)
            {
                return '<div class="sa_dark"><nav aria-label="Paginas" >
                <ul class="pagination justify-content-center">
                  <li class="page-item bg-warning text-dark text-muted">
                  <a class="page-link bg-warning text-dark" href="'.$url.($page-1).'">Anterior</a>
                  </li>
                  <li class="page-item active bg-warning text-dark">
                  <a class="page-link bg-warning text-dark" href="'.$url.($page-2).'">'.($page-2).'</a>
                  </li>
                  <li class="page-item active">
                  <a class="page-link bg-warning text-dark" href="'.$url.($page-1).'">'.($page-1).'</a>

                  </li>
                  <li class="page-item">
                  <span class="page-link bg-secondary text-dark">
                  '.$page.'
                  <span class="sr-only">(current)</span>
                </span>
                </li>
                  <li class="page-item">
                  <span class="page-link text-muted bg-warning text-dark">Siguiente</span>
                  </li>
                </ul>
              </nav></div>';
            }
            else 
            {
                return '<nav aria-label="Paginas" >
                <ul class="pagination justify-content-center">
              <li class="page-item bg-warning text-dark">
              <a class="page-link bg-warning text-dark" href="'.$url.($page-1).'">Anterior</a>
              </li>
              <li class="page-item bg-warning text-dark"><a class="page-link bg-warning text-dark" href="'.$url.($page-1).'">'.($page-1).'</a></li>
              <li class="page-item active">
                <span class="page-link bg-secondary text-dark">
                  '.$page.'
                  <span class="sr-only">(current)</span>
                </span>
              </li>
              <li class="page-item"><a class="page-link bg-warning text-dark" href="'.$url.($page+1).'">'.($page+1).'</a></li>
              <li class="page-item">
                <a class="page-link bg-warning text-dark" href="'.$url.($page+1).'">Siguiente</a>
              </li>
            </ul>
          </nav>';
            }
        }
    }
?>