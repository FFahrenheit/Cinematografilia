<?php 
    include_once('Connection.php');
    class Playlists
    {
        public function __construct()
        {
        }

        public function getRandomPlaylists()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT playlist.*, DATE(fecha) as creada,
            (SELECT COUNT(*) FROM playlist_likes WHERE playlist = playlist.clave) as likes,
            (SELECT COUNT(*) FROM playlist_peliculas WHERE playlist = playlist.clave) as peliculas  
            FROM playlist ORDER BY RAND() LIMIT 15";

            $result = mysqli_query($conn, $sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $clave = $data['clave'];
                    $out .= "<td><a style='color: white;' href='playlist.php?id=$clave'>".$data['nombre']."</a>";
                    $out .= '<td><h6>'.$data['descripcion'].'</span></h6>';
                    $out .= '<td>'.$data['creada'].'</td>';
                    $out .= '<td><a class="text-white"href="profile.php?user='.$data['creador'].'">'.$data['creador'].'</a></td>';
                    $out .= '<td><i title="Me gustas" class="fas fa-thumbs-up"></i> '.$data['likes'].'</td>';
                    $out .= '<td><i title="Peliculas en esta lista" class="fas fa-film"></i> '.$data['peliculas'].'</td>';
                    $out .= '<td><a class="btn btn-warning" href="playlist.php?id='.$clave.'">Ver lista</a></td>';
                    $out .= '</tr>';
                }
                $out .='</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>No hay listas de reproducción</p>";
            }
        }

        public function getQueriedPlaylists($q)
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT playlist.*, DATE(fecha) as creada,
            (SELECT COUNT(*) FROM playlist_likes WHERE playlist = playlist.clave) as likes,
            (SELECT COUNT(*) FROM playlist_peliculas WHERE playlist = playlist.clave) as peliculas  
            FROM playlist WHERE nombre like '%$q%' OR descripcion LIKE '%$q%' LIMIT 20";

            $result = mysqli_query($conn, $sql);
            if($result && $result->num_rows>0)
            {
                $out = "<p class='text-white'>Resultados de búsqueda para $q</p>";
                $out .= '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $clave = $data['clave'];
                    $out .= "<td><a style='color: white;' href='playlist.php?id=$clave'>".$data['nombre']."</a>";
                    $out .= '<td><h6>'.$data['descripcion'].'</span></h6>';
                    $out .= '<td>'.$data['creada'].'</td>';
                    $out .= '<td><a class="text-white"href="profile.php?user='.$data['creador'].'">'.$data['creador'].'</a></td>';
                    $out .= '<td><i title="Me gustas" class="fas fa-thumbs-up"></i> '.$data['likes'].'</td>';
                    $out .= '<td><i title="Peliculas en esta lista" class="fas fa-film"></i> '.$data['peliculas'].'</td>';
                    $out .= '<td><a class="btn btn-warning" href="playlist.php?id='.$clave.'">Ver lista</a></td>';
                    $out .= '</tr>';
                }
                $out .='</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>No hay resultados de reproducción</p>";
            }
        }
    }
