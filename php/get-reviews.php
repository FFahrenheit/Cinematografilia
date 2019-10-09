<?php
    require_once('Connection.php');
    $temp = new Connection();
    $conn = $temp->getConnection();
    session_start();

    $movie = $_POST['movie'];
    $order = $_POST['order']=="likes"? "counter" : "fecha";

    $sql = "SELECT review.*, (SELECT COUNT(*) FROM review_like WHERE review = review.clave) as counter FROM review
    WHERE review.pelicula = '$movie' 
    GROUP BY review.clave ORDER BY $order DESC;";
    $result = mysqli_query($conn,$sql);
    if($result && $result->num_rows>0)
    {
        $out="";
        while($data = mysqli_fetch_assoc($result))
        {
            $out .= '<li class="media rounded">';
            
            $texto = $data['texto'];
            $fecha = $data['fecha'];
            $user = $data['usuario'];
            $clave = $data['clave'];

            $tmp = new Connection();
            $con = $tmp->getConnection();
            $sql = "SELECT imagen FROM usuario WHERE username = '$user'";
            $rs = mysqli_query($con,$sql);
            $result2 = mysqli_fetch_assoc($rs);
            $img = $result2['imagen'];
            $sql = "SELECT valor FROM calificacion WHERE usuario = '$user' AND pelicula = '$movie'";
            $rs = mysqli_query($con,$sql);
            $result2 = mysqli_fetch_assoc($rs);
            $cal = $result2['valor'];
            
            $out.='<a href="profile.php?user='.$user.'" class="pull-left">'; 
            $out.='<img src="'.$img.'" alt="Imagen" class="img-circle">';
            $out.='</a>';
            $out.='<div class="media-body">';
            $out.='<a href="profile.php?user='.$user.'"><strong class="text-warning">'.$user.'&nbsp;</strong></a>';
            $out .= '<small class="text-muted">'.$fecha.'</small>';
            if($data['spoilers']=="1")
            {
                $out .= '<span title="Advertencia, esta reseña contiene spoilers" class="badge badge-warning">SpoilerAlert!</span>';
            }
            $out.= ($data['recomendada']=="1") ? '<span class="badge badge-success">Recomendada</span>' : '<span class="badge badge-danger">No recomendada</span>';
            $out .= '<small>  &#9733;'.$cal.'/5 </small>';
            $out .= '<div class="p-r">';
            $out .= doILike($clave);
            $out .= $data['counter'];
            if(isset($_SESSION['username']) && $data['usuario'] == $_SESSION['username'])
            {
                $out.= '<i title="Eliminar reseña" onclick="deleteReview('."'".$clave."'".')" class="fas fa-trash"></i>';
            }
            $out .= '<i class="fas fa-flag p-r" onclick="report('."'".$clave."'".')" title="Reportar"></i>';
            $out.='</div>';
            $out.='<p>'.$texto.'</p>';
            $out.='</div>';           
            $out .= '</li>';
        }
        echo $out;
    }
    echo "";

    function doILike($clave){
        $t = new Connection();
        $cn = $t->getConnection();
        if(isset($_SESSION['username']))
        {
            $user = $_SESSION['username'];
            $sql = "SELECT * FROM review_like WHERE review = $clave AND usuario = '$user'";
            $rs = mysqli_query($cn,$sql);
            if($rs && $rs->num_rows>0)
            {
                return '<i onclick="unlikeReview('.$clave.',this)" title="Ya no me gusta esta reseña" class="fas fa-thumbs-up"></i> '; 
            }
            else 
            {
                return '<i onclick="likeReview('.$clave.',this)" title="Marcar como me gusta" class="far fa-thumbs-up"></i> '; 
            }
        }
        else 
        {
            return '<i title="Cantidad de me gusta" class="far fa-thumbs-up"></i> ';
        }
    }
