var rText = document.getElementById('modal-body');
var rType;
var rMovie;
var rTitle = document.getElementById('exampleModalLabel');

function unfavorite(movie) {
    console.log("Quitar de favoritos " + movie);
    rtype = 'unfavorite';
    rMovie = movie;
    rTitle.innerHTML = 'Quitar de favoritos';
    rText.innerHTML = '¿Seguro que desea quitar de favoritos?';
}

function unwatch(movie) {
    console.log("No quiero verla " + movie);
    rtype = 'unwatch';
    rMovie = movie;
    rTitle.innerHTML = 'Quitar de lista por ver';
    rText.innerHTML = '¿Seguro que desea quitar de la lista por ver?';
}

function watchMovie(movie) {
    console.log("Ya vi " + movie);
    rTyep = 'watched';
    rMovie = movie;
    rTitle.innerHTML = 'Marcar como vista';
    rText.innerHTML = '¿Marcar película como vista?';
}