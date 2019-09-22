$(document).ready(() => {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;
    $("#date-watch").attr("value", today);
});

var formWatched = document.getElementById('form-watched');
var aMovie;

function addWatched(movie) {
    aMovie = movie;
    $('#watchedModal').modal('toggle');
}

function addToPlaylist(movie, playlist) {
    var data = new FormData();
    data.append("movie", movie);
    data.append("playlist", playlist);
    console.log(movie + ' ' + playlist);
    fetch('../../php/add-to-playlist.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de sesión", "danger");
                break;
            case '1':
                alertar("Error de conexión", "danger");
                break;
            case '2':
                alertar("La película ya está en esta lista", "warning");
                break;
            case '3':
                alertar("Película agregada a la lista. <a class='text-success' href='playlist.php?id=" + playlist + "'>Ver lista</a>", "success");
                break;
        }
    });
}

function seeForm() {
    var data = new FormData(formWatched);
    data.append("movie", aMovie);
    console.log(data.get("liked"));
    console.log(data.get("fecha"));

    fetch('../../php/add-watched.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        $('#watchedModal').modal('toggle');
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "danger");
                break;
            case '1':
                alertar("La película ya está marcada como vista", "warning");
                break;
            case '2':
                alertar("Película agregada", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            default:
                alertar("Error desconocido", "danger");
        }
    })

}

function addToFavorite(movie) {
    data = new FormData();
    console.log(movie);
    data.append("movie", movie);
    fetch('../../php/add-favorite.php', {
        method: 'POST',
        body: data
    }).then((resp) => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de sesión", "danger")
                break;
            case '1':
                alertar("Error de conexión", "danger");
                break;
            case '2':
                alertar("La película ya está en favoritos", "warning");
                break;
            case '3':
                alertar("Película agregada", "success");
                break;
        }
    });
}

function addToWatchlist(movie) {
    console.log("Movie: " + movie);
    data = new FormData();
    data.append("movie", movie);
    fetch('../../php/add-watchlist.php', {
        method: 'POST',
        body: data
    }).then((resp) => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de sesión", "danger")
                break;
            case '1':
                alertar("Error de conexión", "danger");
                break;
            case '2':
                alertar("La película ya está en la lista de películas por ver", "warning");
                break;
            case '3':
                alertar("La película ya se encuentra en la lista de vistas", "warning");
                break;
            case '4':
                alertar("Película agregada", "success");
                break;
        }
    });
}