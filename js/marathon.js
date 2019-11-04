var marathonForm = document.getElementById('new-marathon');

if (marathonForm != null) {
    (function() {
        'use strict';
        var form = marathonForm;
        window.addEventListener('load', function() {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();

    marathonForm.addEventListener('submit', (e) => {
        e.preventDefault();
        if (checkDates() && marathonForm.checkValidity()) {
            var data = new FormData(marathonForm);
            fetch('../../php/new-marathon.php', {
                method: 'POST',
                body: data
            }).then(resp => {
                return resp.json();
            }).then(r => {
                console.log(r);
                switch (r) {
                    case 'connection':
                        alertar("Error en el servidor", "warning");
                        break;
                    case 'query':
                        alertar("No se ha podido enviar la solicitud", "danger");
                        break;
                    default:
                        if (typeof r == 'number') {
                            alertar("Redirigiendo a enlistar películas", "success");
                            goTop();
                            setTimeout(() => {
                                window.location.href = "add-movies.php?clave=" + r;
                            }, 3000);
                        } else {
                            alertar("Error interno: " + r, "danger");
                        }
                        break;
                }
                goTop();
            })
        }
    });

    function checkDates() {
        var currentDate = new Date();
        // console.log(current);
        // var currentDate = new Date(current.getFullYear(), current.getMonth() + 1, current.getDay());
        currentDate.setHours(0, 0, 0, 0);
        var beginDate = new Date($('#begin').val().replace('-', '/')); //Some javascript buggy shit 
        beginDate.setHours(0, 0, 0, 0);
        var endDate = new Date($('#end').val().replace('-', '/'));
        endDate.setHours(0, 0, 0, 0);
        console.log(currentDate + beginDate + endDate);
        var difference = (beginDate - currentDate) / (1000 * 60 * 60 * 24);
        console.log(difference);
        if (difference >= 3 && difference <= 30) {
            difference = (endDate - beginDate) / (1000 * 60 * 60 * 24);
            if (difference >= 2 && difference <= 15) {
                return true;
            } else {
                alertar("Los maratones deben durar entre 2 y 15 días, este dura " + difference + " días", "warning");
                goTop();
                return false;
            }

        } else {
            alertar("Los maratones deben empezar entre 3 y 30 días, este empieza en " + difference + " días", "warning");
            goTop();
            return false;
        }
    }
}

var key = null;
var timer = null;
var count;

function setKey(clave) {
    key = clave;
    addMovie('0', '');
    setTimeout(() => {
        updateCounter();
    }, 1000);
}

function removeMovie(id, title, reference) {
    var data = new FormData();
    data.append("movie", id);
    data.append("marathon", key);
    fetch('../../php/delete-movie-marathon.php', {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        goTop();
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de conexión", "danger");
                break;
            case '1':
                alertar("No se ha podido eliminar", "warning");
                break;
            case '2':
                alertar(title + " eliminada del maratón", "success");
                setKey(key);
                break;
            default:
                alertar("Error interno", "danger");
                break;
        }
    })

}


function updateCounter() {
    count = $('#coolTable tr').length;
    console.log("Hijos: " + count);
    $("#count").html(count);
    if (count >= 3 && count <= 15) {
        $('#okay').prop("disabled", false); // Element(s) are now enabled.
    } else {
        $('#okay').prop("disabled", true); // Element(s) are now enabled.
    }
}

function goTop() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
}

function addMovie(id, title) {
    $.ajax({
            url: '/spoileralert/php/add-movie-marathon.php',
            type: 'POST',
            datatype: 'html',
            data: {
                movie: id,
                marathon: key
            }
        })
        .done((r) => {
            switch (r) {
                case 'connection':
                    alertar("Error de conexión", "warning");
                    break;
                case 'query':
                    alertar("No se ha podido agregar la película, ya que está repetida", "danger");
                    break;
                case 'repeat':
                    alertar("No se pueden agregar películas repetidas", "danger");
                    break;
                default:
                    if (id != '0') {
                        alertar(title + " agregada", "success");
                    }
                    $("#currentMovies").html(r);
                    updateCounter();
            }
        })
}

function ready() {
    var data = new FormData();
    data.append("marathon", key);
    fetch('../../php/send-marathon.php', {
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
                alertar("No se ha enviar el maratón", "warning");
                break;
            case '2':
                alertar("Se ha enviado el maratón para su revisión. Espere su respuesta...", "success");
                setTimeout(() => {
                    window.location.href = 'index.php'; //¿Mis maratones?
                }, 3500);
                break;
            default:
                alertar("Error interno", "danger");
                break;

        }
    })
}

function searchMovie() {
    console.log("Buscando película");
    clearTimeout(timer);
    timer = setTimeout(() => {
        console.log("Buscar");
        var name = document.getElementById('name').value;
        console.log(name);
        $.ajax({
                url: '/spoileralert/php/get-search-marathon.php',
                type: 'POST',
                datatype: 'html',
                data: { search: name }
            })
            .done((r) => {
                $("#answers").html(r);
                // console.log(r);
            })
    }, 1000);
}

function searchMoviee() {
    searchMovie();
}