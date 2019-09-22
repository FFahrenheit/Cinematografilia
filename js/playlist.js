var xform = document.getElementById('new-playlist');

(function() {
    'use strict';

    window.addEventListener('load', function() {
        var form = document.getElementById('new-playlist');
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }, false);
})();

xform.addEventListener('submit', (e) => {
    var ok = false;
    setTimeout(() => {
        if (!ok) {
            alertar("Error desconocido", "danger");
        }
        setTimeout(() => {
            window.location.reload(true);

        }, 3000);
    }, 2000);
    e.preventDefault();
    var rData = new FormData(xform);
    var link = '../../php/create-playlist.php?name=' + rData.get("name") + '&description=' + rData.get("description");
    console.log(link);
    if (xform.checkValidity()) {
        fetch(link).then((resp) => {
            return resp.json();
        }).then((r) => {
            ok = true;
            console.log(r);
            switch (r) {
                case '0':
                    alertar("Error de conexión", "danger");
                    break;
                case '1':
                    alertar("No se pudo crear la lista", "danger");
                    break;
                case '2':
                    alertar("Lista creada. Regresando a inicio...", "success");
                    setTimeout(() => {
                        window.location.href = "index.php";
                    }, 3000);
                    break;
            }
        })
    }
});

var oldTitleHTML;
var oldDescriptionHTML;
var playlist;

function showPlaylistForm(_playlist, name, description) {
    window.location.href = "#description-form";
    playlist = _playlist;
    oldTitleHTML = $("#title-form").html();
    oldDescriptionHTML = $("#description-form").html();

    $("#title-form").html("<br><input maxlength='30' class='form-control' id='name' placeholder='Ingrese nuevo nombre' value = '" + name + "'><br>");
    $("#description-form").html("<textarea id = 'desc' rows='5' maxlength='250' class='form-control' placeholder='Ingrese su nueva descripción'>" + description + "</textarea>" +
        "<br><a onclick='backTo()' class='btn btn-danger text-light'>Cancelar</a>&nbsp;<a onclick='rename()' class='btn btn-warning text-dark'>Guardar</a");
}

function rename() {
    var newTitle = $("#name").val();
    var newDescription = $("#desc").val();
    console.log(newTitle + " " + newDescription);
    if (newTitle.length < 2) {
        alertar("El titulo de la lista debe tener mínimo 2 caracteres. <a class='text-danger' href='#title-form'>Reintentar</a>", "danger");
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    } else {
        var data = new FormData();
        data.append("name", newTitle);
        data.append("description", newDescription);
        data.append("playlist", playlist);
        console.log(playlist);
        fetch('../../php/rename-playlist.php', {
            method: 'POST',
            body: data
        }).then(resp => {
            return resp.json();
        }).then(r => {
            console.log(r);
            switch (r) {
                case '0':
                    alertar("Error de conexión", "danger");
                    break;
                case '1':
                    alertar("No se han podido guardar los cambios", "warning");
                    break;
                case '2':
                    alertar("Cambios hechos", "success");
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 3000);
                    break;
                default:
                    alertar("Error desconocido", "danger");
                    break;
            }
        })
    }
}

function backTo() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    $("#title-form").html(oldTitleHTML);
    $("#description-form").html(oldDescriptionHTML);
}

function func(m, p) {
    modToggle();
    var data = new FormData();
    data.append("playlist", p);
    data.append("movie", m);
    fetch('../../php/remove-movie-playlist.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "danger");
                break;
            case '1':
                alertar("No se ha podido eliminar la película seleccionada", "warning");
                break;
            case '2':
                alertar("Película removida de la lista", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            default:
                alertar("Error desconocido", "danger");
        }
    })
}


function deleteMovie(movie, playlist) {
    modal('Quitar película', '¿Seguro que desea eliminar la película de la lista?', 'func("' + movie + '","' + playlist + '");');
}

function like(playl) {
    console.log("Nice");
    var data = new FormData();
    data.append("playlist", playl);
    fetch('../../php/like-playlist.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "danger");
                break;
            case '1':
                alertar("Esta lista ya te gusta", "warning");
                break;
            case '2':
                alertar("Te gusta esta lista de reproducción", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            default:
                alertar("Error desconocido", "danger");
        }
    });
}

function unlike(playl) {
    console.log("Chale");
    var data = new FormData();
    data.append("playlist", playl);
    fetch('../../php/dislike-playlist.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "danger");
                break;
            case '1':
                alertar("No se pudo procesar correctamente la petición", "warning");
                break;
            case '2':
                alertar("Esta lista ya no te gusta", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            default:
                alertar("Error desconocido", "danger");
        }
    })
}