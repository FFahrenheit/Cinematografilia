<?php 
    include_once("Connection.php");

    class Question
    {
        public $user;
        public $active;

        public function __construct()
        {
            if(isset($_SESSION['username']))
            {
                $this->user = $_SESSION['username'];
            }
            else 
            {
                $this->user = null;
            }
        }

        public function getQuestion()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT pregunta FROM preguntas WHERE estado = 'activa'";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $this->active = true;
                $data = mysqli_fetch_assoc($rs);
                return $data['pregunta'];
            }
            else 
            {
                $this->active=false;
                return "Por el momento no hay una pregunta qué responder<br>Vuelve más tarde";
            }
        }

        public function getSearchBar()
        {
            if($this->user == null && $this->active)
            {
                return '<a href="login.php">Inicia sesión para contestar la pregunta</a>';
            }
            else if($this->active)
            {
                $temp = new Connection();
                $conn = $temp->getConnection();

                if($temp->getCount($conn,"SELECT COUNT(*) FROM respuestas WHERE 
                usuario = '$this->user' AND pregunta = (SELECT clave FROM preguntas WHERE estado = 'activa' LIMIT 1)")==0)
                {
                    return 
                    '<form id="answer">
                        <div class="form-group">
                            <label for="">Respuesta: </label>
                            <br>
                            <input id="name" onkeyup="search()" name="name" type="text" placeholder="Busque la película para su respuesta" class="form-control" required minlength="2">
                            <button class="btn btn-warning">Enviar</buton>
                        </div>
                    </form>';
                }
                else 
                {
                    return 
                    '<h3><strong>Ya ha enviado una respuesta, pero puede editarla si así lo desea</strong></h3>
                    <form id="answer">
                        <div class="form-group">
                            <label for="">Respuesta: </label>
                            <br>
                            <input id="name" onkeyup="search()" name="name" type="text" placeholder="Busque la película para su respuesta" class="form-control" required minlength="2">
                            <button class="btn btn-warning">Enviar</buton>
                        </div>
                    </form>';
                }
            }
            else
            {
                return "";
            }
        }
    }

?>