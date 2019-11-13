$(document).ready(() => {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;
    $("#date-watch").attr("value", today);
    $("#date-watch").attr("max", today);
});

var addTo;

var formWatched = document.getElementById('form-watched');
var aMovie;

function recomend(movie) {
    $("#recomendModal").modal("toggle");
    aMovie = movie;
}

function sendRecommendation() {
    console.log($("#recomend-list").val());
    $("#recomendModal").modal("toggle");
    if ($("#recomend-list").val() == '0') {
        alertar("Agregue amigos para poder enviarles recomendaciones", "warning");
    } else if (!$("#recomend-list").val()) {
        alertar("Seleccione un amigo para recomendarle la película", "danger");
    } else {
        var data = new FormData();
        data.append("movie", aMovie);
        data.append("user", $("#recomend-list").val());
        fetch('../../php/send-recomendation.php', {
            method: 'POST',
            body: data
        }).then(resp => {
            return resp.json();
        }).then(r => {
            console.log(r);
            switch (r) {
                case '0':
                case '1':
                case '3':
                case '5':
                    alertar("Error de servidor", "danger");
                    break;
                case '2':
                    alertar("No se le puede recomendar esta película al usuario, ya que ya la tiene en una lista o la ha bloqueado", "warning");
                    break;
                case '4':
                    alertar("Error con la API, se ha logrado la recomendación", "secondary");
                    break;
                case '6':
                    alertar("Recomendación enviada", "success");
                    break;
            }
        })
    }
}

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

function fun_addLike(movie) {
    var data = new FormData();
    data.append("movie", movie);
    console.log("Marcar a like");
    fetch('../../php/add-liked.php', {
        method: 'POST',
        body: data
    }).then(r => {
        return r.json();
    }).then(resp => {
        console.log(resp);
        switch (resp) {
            case '0':
                alertar("Error de sesión", "danger")
                break;
            case '1':
                alertar("Error de conexión", "danger");
                break;
            case '2':
                alertar("La película ya está en me gusta", "warning");
                break;
            case '3':
                alertar("Película agregada. <a class='text-success' href='../../php/my-profile.php'>Ver mi perfil </a>", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
        }
    });
}

function seeForma(bDelete) {
    if (bDelete) {
        console.log("what");
        var data = new FormData(formWatched);
        console.log(bDelete);
        data.append("movie", aMovie);
        data.append("foo", "yes");
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
                    alertar("Película agregada. <a class='text-success' href='../../php/my-profile.php'>Ver mi perfil </a>", "success");
                    console.log(addTo);
                    console.log("JAJAJ");
                    switch (addTo) {
                        case 'favorite':
                            fun_addToFavorite(aMovie);
                            fun_addLike(aMovie);
                            break;
                        case 'like':
                            fun_addLike(aMovie);
                            break;
                        default:
                            setTimeout(() => {
                                window.location.reload(true);
                            }, 3000);
                    }
                    break;
                default:
                    alertar("Error desconocido", "danger");
            }
        })
    } else {
        seeForm();
    }
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
                alertar("Película agregada. <a class='text-success' href='../../php/my-profile.php'>Ver mi perfil </a>", "success");
                console.log(addTo);
                console.log("JAJAJ");
                switch (addTo) {
                    case 'favorite':
                        fun_addToFavorite(aMovie);
                        fun_addLike(aMovie);
                        break;
                    case 'like':
                        fun_addLike(aMovie);
                        break;
                    default:
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 3000);
                }
                break;
            default:
                alertar("Error desconocido", "danger");
        }
    })

}

function addToFavorite(movie, st) {
    if (st == 1) {
        fun_addLike(movie);
        fun_addToFavorite(movie);
    } else {
        aMovie = movie;
        $('#watchedModal').modal('toggle');
        addTo = 'favorite';
    }
}

function fun_addToFavorite(movie) {
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
                alertar("Película agregada. <a class='text-success' href='../../php/my-profile.php'>Ver mi perfil </a>", "success");
                break;
            case '4':
                alertar("Lista de favoritos llena, libere espacio en <a href='../../php/my-profile.php'>su perfil</a>", "danger");
                break;
        }
    });
}


function addToLikes(movie, st) {
    if (st == 1) {
        fun_addLike(movie);
    } else {
        aMovie = movie;
        $('#watchedModal').modal('toggle');
        addTo = 'like';
    }
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
                alertar("Película agregada. <a class='text-success' href='../../php/my-profile.php'>Ver mi perfil </a>", "success");
                break;
        }
    });
}

var action;
var args;
var moov;

function confirmation() {
    switch (action) {
        case 'watchlist':
            addToWatchlist(moov);
            break;
        case 'block':
            generalRequest('../../php/block-recomendation.php');
            break;
        case 'unblock':
            generalRequest('../../php/unblock-recomendation.php');
            break;
        case 'delete':
            generalRequest('../../php/delete-recomendation.php');
            break;
        case 'aDelete':
            generalRequest('../../php/delete-review.php');
            break;
        case 'aDiscard':
            generalRequest('../../php/discard-report-admin.php');
            break;
        case 'dQuestion':
            generalRequest('../../php/delete-question.php');
            break;
    }
}

function generalRequest(url) {
    $("#confirmationModal").modal("toggle");
    fetch(url, {
        method: 'POST',
        body: args
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r)
        switch (r) {
            case '0':
            case 0:
                alertar("Error de conexión", "warning");
                break;
            case '1':
            case 1:
                alertar("No se ha podido guardar el cambio", "danger");
                break;
            case '2':
            case 2:
                alertar("Accion realizada correctamente", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            case '3':
            case 3:
                alertar("Accion previamente realizada", "warning");
                break;
            default:
                alertar("Error desconocido", "danger");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
        }
    })
}

function addWatchlist(movie) {
    console.log(movie);
    moov = movie;
    $("#confirmationModalLabel").html("Agregar a peliculas por ver");
    $("#confirmationModalBody").html("¿Desea agregar la película a la lista por ver?");
    args = new FormData();
    args.append("movie", movie);
    action = 'watchlist';
    $("#confirmationModal").modal("toggle");
}

function block(movie) {
    console.log(movie);
    $("#confirmationModalLabel").html("Bloquear recomendación");
    $("#confirmationModalBody").html("¿Seguro que desea no volver a recibir esta recomendación?");
    args = new FormData();
    args.append("movie", movie);
    action = 'block';
    $("#confirmationModal").modal("toggle");
}

function unblockMovie(movie) {
    console.log(movie);
    $("#confirmationModalLabel").html("Desbloquear recomendación");
    $("#confirmationModalBody").html("¿Seguro que desea desbloquear esta recomendación? Le podrán volver a recomendar esta película");
    args = new FormData();
    args.append("movie", movie);
    action = 'unblock';
    $("#confirmationModal").modal("toggle");
}

function deleteR(movie) {
    console.log(movie);
    $("#confirmationModalLabel").html("Borrar recomendaciones");
    $("#confirmationModalBody").html("¿Seguro que desea borrar las recomendaciones de esta pelicula?");
    args = new FormData();
    args.append("movie", movie);
    action = 'delete';
    $("#confirmationModal").modal("toggle");
}