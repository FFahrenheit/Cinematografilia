function deleteRev(rev) {
    console.log(rev);
    $("#confirmationModalLabel").html("Eliminar reseña");
    $("#confirmationModalBody").html("¿Seguro que desea borrar esta reseña?");
    args = new FormData();
    args.append("clave", rev);
    action = 'aDelete';
    $("#confirmationModal").modal("toggle");
}

function discardRev(rev) {
    console.log(rev);
    $("#confirmationModalLabel").html("Descartar reporte");
    $("#confirmationModalBody").html("¿Seguro que desea descartar este reporte?");
    args = new FormData();
    args.append("clave", rev);
    action = 'aDiscard';
    $("#confirmationModal").modal("toggle");
}

function deleteQuestion(clave) {
    console.log(clave);
    $("#confirmationModalLabel").html("Eliminar pregunta");
    $("#confirmationModalBody").html("¿Seguro que eliminar la pregunta de la cola?");
    args = new FormData();
    args.append("clave", clave);
    action = 'dQuestion';
    $("#confirmationModal").modal("toggle");
}

if (document.getElementById('new-question') != null) {
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            var form = document.getElementById('new-question');
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
}

if (document.getElementById('formulario') != null) {
    (function() {
        'use strict';

        window.addEventListener('formulario', function() {
            var form = document.getElementById('formulario');
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
}

var qForm = document.getElementById('new-question');

if (qForm != null) {
    qForm.addEventListener('submit', e => {
        e.preventDefault();
        if (qForm.checkValidity()) {
            fetch('../../php/add-question.php', {
                method: 'POST',
                body: new FormData(qForm)
            }).then(resp => {
                return resp.json();
            }).then(r => {
                console.log(r);
                switch (r) {
                    case '0':
                        alertar("Error interno", "danger");
                        break;
                    case '1':
                        alertar("No se ha podido agregar la pregunta", "danger");
                        break;
                    case '2':
                        alertar("Pregunta agregada", "success");
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 2500);
                        break;
                }
            })
        }
    })
}

var marathon = null;
var rKey = null;

function rejectMarathon() {
    send(rKey, 'rechazado');
    $("#confirmationModal").modal("toggle");
}

function reason() {
    $("#confirmationModal").modal("toggle");
}

function setMarathonKey(key) {
    marathon = key;
}

function send(key, status) {
    console.log("ola " + status);
    var data = new FormData(document.getElementById('formulario'));
    data.append("key", key);
    data.append("status", status);
    if (status == 'rechazo') {
        rKey = key;
        reason();
    } else {
        fetch('../../php/update-marathon.php', {
            method: 'POST',
            body: data
        }).then(resp => { return resp.json() }).then(r => {
            console.log(r);
            switch (r) {
                case '0':
                    alertar("Error de conexión", "danger");
                    break;
                case '1':
                    alertar("No se ha podido realizar la acción, intente de nuevo", "warning");
                    break;
                case '2':
                    alertar("El maratón ha sido " + status + " exitosamente", "success");
                    setTimeout(() => {
                        window.location.href = "review-marathons.php";
                    }, 3000);
                    break;
                default:
                    alertar("Error interno", "danger");
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 2500);
            }
        })
    }
}