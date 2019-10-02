<?php
    require_once('Connection.php');
    $temp = new Connection();
    $conn = $temp->getConnection();

    $movie = $_POST['movie'];
    $order = $_POST['order']=="likes"? "fecha" : "fecha";

    $sql = "SELECT * FROM review WHERE pelicula = '$movie' ORDER BY $order DESC";
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
                $out .= '<span class="badge badge-warning">SpoilerAlert!</span>';
            }
            $out.= ($data['recomendada']=="1") ? '<span class="badge badge-success">Recomendada</span>' : '<span class="badge badge-danger">No recomendada</span>';
            $out .= '<i class="fas fa-flag" onclick="report('."'".$clave."'".')" title="Reportar"></i>';
            $out .= doILike($clave);
            $out.='<p>'.$texto.'</p>';
            $out.='</div>';           
            $out .= '</li>';
        }
        echo $out;
    }
    echo "";

    function doILike($clave){
        return '<i class="far fa-thumbs-up"></i>';
    }
