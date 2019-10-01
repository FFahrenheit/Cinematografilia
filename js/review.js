var cal = 1;

$("#review-list").on('change', () => {
    var optionText = $("#review-list option:selected").text();
    console.log(optionText);
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