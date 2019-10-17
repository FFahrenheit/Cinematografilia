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

var qForm = document.getElementById('new-question');

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