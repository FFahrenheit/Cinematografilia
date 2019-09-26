var rText = document.getElementById('modal-body');
var rType;
var rMovie;
var rTitle = document.getElementById('exampleModalLabel');
var rUser;
var isUser = false;

function block(user) {
    rType = '../../php/block-user.php';
    isUser = true;
    rUser = user;
    rTitle.innerHTML = 'Bloquear usuario';
    rText.innerHTML = '¿Seguro que quiere bloquear a ' + user + '?';
    $("#exampleModal").modal("toggle");
}

function unfriend(user) {
    rType = '../../php/unfriend.php';
    isUser = true;
    rUser = user;
    rTitle.innerHTML = 'Borrar amigo';
    rText.innerHTML = '¿Seguro que quiere eliminar la amistad con ' + user + '?';
    $("#exampleModal").modal("toggle");
}

function unblock(user) {
    rType = '../../php/unblock-user.php';
    isUser = true;
    rUser = user;
    rTitle.innerHTML = 'Desbloquear usuario';
    rText.innerHTML = '¿Seguro que quiere desbloquear a ' + user + '?';
    $("#exampleModal").modal("toggle");
}

function accept(user) {
    rType = '../../php/accept-friend.php';
    isUser = true;
    rUser = user;
    $("#exampleModal").modal("toggle");
    rTitle.innerHTML = 'Aceptar amistad';
    rText.innerHTML = '¿Aceptar la solicitud de ' + user + '?';
    $("#exampleModal").modal("toggle");
}

function reject(user) {
    rType = '../../php/reject-friend.php';
    isUser = true;
    rUser = user;
    $("#exampleModal").modal("toggle");
    rTitle.innerHTML = 'Rechazar amistad';
    rText.innerHTML = '¿Rechazar la solicitud de ' + user + '?';
    $("#exampleModal").modal("toggle");
}

function add(user) {
    rType = '../../php/add-friend.php';
    isUser = true;
    rUser = user;
    $("#exampleModal").modal("toggle");
    rTitle.innerHTML = 'Agregar amigo';
    rText.innerHTML = '¿Enviar solicitud a ' + user + '?';
    $("#exampleModal").modal("toggle");
}

function cancel(user) {
    rType = '../../php/cancel-friend.php';
    isUser = true;
    rUser = user;
    $("#exampleModal").modal("toggle");
    rTitle.innerHTML = 'Cancelar';
    rText.innerHTML = '¿Cancelar la solicitud de amistad a ' + user + '?';
    $("#exampleModal").modal("toggle");
}

function unfavorite(movie) {
    isUser = false;
    console.log("Quitar de favoritos " + movie);
    rType = '../../php/unfavorite.php';
    rMovie = movie;
    rTitle.innerHTML = 'Quitar de favoritos';
    rText.innerHTML = '¿Seguro que desea quitar de favoritos?';
}

function unwatch(movie) {
    isUser = false;
    console.log("No quiero verla " + movie);
    rType = '../../php/unwatch.php';
    rMovie = movie;
    rTitle.innerHTML = 'Quitar de lista por ver';
    rText.innerHTML = '¿Seguro que desea quitar de la lista por ver?';
}

function unwatched(movie) {
    isUser = false;
    console.log("No vi " + movie);
    rType = '../../php/unwatched.php';
    rMovie = movie;
    rTitle.innerHTML = 'Quitar de películas vistas';
    rText.innerHTML = '¿Seguro que desea quitar de la lista de películas vistas?';
}

function watchMovie(movie) {
    isUser = false;
    console.log("Ya vi " + movie);
    rType = '../../watchMovie.php';
    rMovie = movie;
    rTitle.innerHTML = 'Marcar como vista';
    rText.innerHTML = '¿Marcar película como vista?';
}

function confirmAction() {
    var dataArg = (!isUser) ? 'movie' : 'user';
    var dataValue = (!isUser) ? rMovie : rUser;
    console.log(dataArg);
    console.log(rType);
    movie = new FormData();
    movie.append(dataArg, dataValue);
    fetch(rType, {
        method: 'POST',
        body: movie
    }).then(res => {
        return res.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case 'error':
                alertar("No se pudo procesar la solicitud, recargue la página.", "danger");
                return;
            case 'ok':
                alertar("Acción realizada correctamente", 'success');
                return;
            case 'connection':
                alertar("Error en la conexión", 'danger');
                return;
            case 'query':
                alertar("La acción ya ha sido previamente realizada", 'warning');
                return;
        }
        alertar("Error desconocido", "danger");
        return;
    });
    $('#exampleModal').modal('toggle');
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    setTimeout(() => {
        window.location.reload(true);
    }, 3000);
}