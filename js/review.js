var cal = 1;
var movie;

function setMovie(m) {
    console.log(m);
    movie = m;
}

$("#review-list").on('change', () => {
    var optionText = $("#review-list option:selected").text();
    console.log(optionText);
    if (optionText == 'Más reciente') {
        getReviews("recent");
    } else {
        getReviews("likes");
    }
})

function calification(type, stars) {
    cal = stars;
    for (var i = 1; i <= stars; i++) {
        var id = "#" + type + i;
        console.log("poner" + id);
        $(id).removeClass("far fa-star");
        $(id).addClass("fas fa-star");
    }
    for (var i = stars + 1; i <= 5; i++) {
        var id = "#" + type + i;
        console.log("quitar" + id);
        $(id).removeClass("fas fa-star");
        $(id).addClass("far fa-star");
    }
}

function sendCalification(movie) {
    console.log(movie);
    console.log(cal);
    var data = new FormData();
    data.append("movie", movie);
    data.append("calification", cal);
    $("#calificationModal").modal("toggle");
    fetch('../../php/add-calification.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "warning");
                break;
            case '1':
                alertar("No se pudo guardar la calificación", "danger");
                break;
            case '2':
                alertar("Calificación guardada", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            default:
                alertar("Error desconocido", "danger");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
        }
    })
}

function seeReviewForm() {
    $("#reviewModal").modal("toggle");
}

function seeCalificationForm() {
    $("#calificationModal").modal("toggle");
}

function sendReview(movie) {
    var data = new FormData(document.getElementById('form-review'));
    console.log(data.get("review"));
    console.log(data.get("recomended"));
    console.log(data.get("spoilers"));
    data.append("movie", movie);
    data.append("calification", cal);
    console.log(data.get("calification"));

    if (data.get("review").length <= 0) {
        alert("Escriba una reseña");
    } else {
        $("#reviewModal").modal("toggle");
        fetch('../../php/add-review.php', {
            method: 'POST',
            body: data
        }).then(resp => {
            return resp.json();
        }).then(r => {
            console.log(r);
            switch (r) {
                case '0':
                    alertar("Error de conexión", "warning");
                    break;
                case '1':
                    alertar("No se pudo guardar la reseña", "danger");
                    break;
                case '2':
                    alertar("Reseña guardada", "success");
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 3000);
                    break;
                default:
                    alertar("Error desconocido", "danger");
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 3000);
            }
        })
    }
}

function getReviews(order) {
    $.ajax({
            url: '/spoileralert/php/get-reviews.php',
            type: 'POST',
            datatype: 'html',
            data: { movie: movie, order: order }
        })
        .done((r) => {
            $("#review-section").html(r);
        })
}

function loadReviews(_movie) {
    movie = _movie;
    getReviews("recent");
}

function likeReview(review, icon) {
    console.log(icon);
    var data = new FormData();
    data.append("review", review);
    fetch('../../php/like-review.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "warning");
                break;
            case '1':
                alertar("No se ha podido marcar reseña como me gusta", "danger");
                break;
            case '2':
                $(icon).removeClass("far fa-thumbs-up");
                $(icon).addClass("fas fa-thumbs-up");
                setTimeout(() => {
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    alertar("Te gusta esta reseña", "success");
                }, 2000);
                break;
            default:
                alertar("Error desconocido", "danger");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
        }
        setTimeout(() => {
            window.location.reload(true);
        }, 3000);
    })
}

function unlikeReview(review, icon) {
    console.log(icon);
    var data = new FormData();
    data.append("review", review);
    fetch('../../php/unlike-review.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "warning");
                break;
            case '1':
                alertar("No se ha podido guardar el cambio", "danger");
                break;
            case '2':
                $(icon).removeClass("fas fa-thumbs-up");
                $(icon).addClass("far fa-thumbs-up");
                setTimeout(() => {
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    alertar("Ya no te gusta esta reseña", "success");
                }, 2000);
                break;
            default:
                alertar("Error desconocido", "danger");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
        }
        setTimeout(() => {
            window.location.reload(true);
        }, 3000);
    })
}

var url;
var arg;
var report;

function deleteReview(clave) {
    $("#alertModalLabel").html("Eliminar reseña");
    $("#alertModalText").html("¿Seguro que desea borrar su reseña?");
    $("#alertModal").modal("toggle");
    url = '../../php/delete-review.php';
    arg = clave;
}

function report(rev) {
    console.log("Reportar");
    $("#alertModalLabel").html("Reportar reseña");
    $("#alertModalText").html("<p>Seleccione el motivo</p>" +
        "<select class='custom-select' id = 'report-list'><option selected>Es ofensivo</option>" +
        '<option>Es spam</option><option>No tiene relación</option><option>Contiene spoilers o contenido que arruina la experiencia</option>' +
        '<option>Otro</option><select>');
    $("#alertModal").modal("toggle");

    url = '../../php/report-review.php';
    arg = rev;
}

function confirm() {
    console.log(url + '\n' + arg);
    var args = new FormData();
    args.append("arg", arg);
    if (report) {
        args.append("reason", $("#report-list option:selected").text())
    }
    fetch(url, {
        method: 'POST',
        body: args
    }).then(resp => {
        return resp.json();
    }).then(r => {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
        console.log(r);
        $("#alertModal").modal("toggle");
        switch (r) {
            case '0':
                alertar("Error de conexión", "warning");
                break;
            case '1':
                alertar("No se ha podido guardar el cambio", "danger");
                break;
            case '2':
                alertar("Accion realizada correctamente", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            default:
                alertar("Error desconocido", "danger");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
        }
    })
}