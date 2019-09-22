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
    playlist = _playlist;
    oldTitleHTML = $("#title-form").html();
    oldDescriptionHTML = $("#description-form").html();

    $("#title-form").html("<br><input maxlenth='30' class='form-control' id='name' placeholder='Ingrese nuevo nombre' value = '" + name + "'>");
    $("#description-form").html("<textarea rows='5' maxlength='250' class='form-control' placeholder='Ingrese su nueva descripción'>" + description + "</textarea>" +
        "<br><a onclick='backTo()' class='btn btn-danger text-light'>Cancelar</a>&nbsp;<a onclick='rename()' class='btn btn-warning text-dark'>Guardar</a");
}

function backTo() {
    $("#title-form").html(oldTitleHTML);
    $("#description-form").html(oldDescriptionHTML);
}

function deleteMovie(movie, playlist) {
    console.log("Hoal");
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
    })
}

function unlike(playl) {
    console.log("Chale");
}