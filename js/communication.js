function newFriendRequest() {
    $("#requestModal").modal("toggle");
}

function sendFriendRequest() {
    var data = new FormData(document.getElementById('new-req'));
    fetch('../../php/add-friend-check.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        $("#requestModal").modal("toggle");
        console.log(r);
        switch (r) {
            case '-1':
                alertar("Error con el sistema", "danger");
                break;
            case '0':
                alertar("Error de conexión", "danger");
                break;
            case '1':
                alertar("No existe el usuario especificado", "warning");
                break;
            case '2':
                alertar("No se puede entablar contacto con este usuario", "danger");
                break;
            case '3':
                alertar("Ya existe una solicitud en transcurso o ya hay una amistad", "warning");
                break;
            case '4':
                alertar("No te puedes enviar una solicitud a ti mismo. Tu ya eres tu propio amigo :)", "warning");
                break;
            case '5':
                alertar("Solicitud enviada", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
        }
    });
}