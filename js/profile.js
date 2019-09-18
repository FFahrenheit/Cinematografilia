var rText = document.getElementById('modal-body');
var rType;
var rMovie;
var rTitle = document.getElementById('exampleModalLabel');

function unfavorite(movie) {
    console.log("Quitar de favoritos " + movie);
    rType = '../../php/unfavorite.php';
    rMovie = movie;
    rTitle.innerHTML = 'Quitar de favoritos';
    rText.innerHTML = '¿Seguro que desea quitar de favoritos?';
}

function unwatch(movie) {
    console.log("No quiero verla " + movie);
    rType = '../../php/unwatch.php';
    rMovie = movie;
    rTitle.innerHTML = 'Quitar de lista por ver';
    rText.innerHTML = '¿Seguro que desea quitar de la lista por ver?';
}

function watchMovie(movie) {
    console.log("Ya vi " + movie);
    rType = '../../watchMovie.php';
    rMovie = movie;
    rTitle.innerHTML = 'Marcar como vista';
    rText.innerHTML = '¿Marcar película como vista?';
}

function confirmAction() {
    console.log(rType);
    movie = new FormData();
    movie.append("movie", rMovie);
    fetch(rType, {
        method: 'POST',
        body: movie
    }).then(res => {
        return res.json();
    }).then(r => {
        switch (r) {
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