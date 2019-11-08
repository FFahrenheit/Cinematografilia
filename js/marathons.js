var path = null;
var data = null;

function enter(marathon) {
    console.log("Entrar");
    data = new FormData();
    data.append("marathon", marathon);
    $("#confirmationModalLabel").html("Entrar al maratón");
    $("#confirmationModalBody").html("¿Desea entrar a este maratón?");
    path = '../../php/enter-marathon.php';
    $("#confirmationModal").modal("toggle");
}

function exit(marathon) {
    console.log("Salir");
    data = new FormData();
    data.append("marathon", marathon);
    $("#confirmationModalLabel").html("Salir del maratón");
    $("#confirmationModalBody").html("¿Desea salir de este maratón? El progreso existente quedará guardado");
    path = '../../php/exit-marathon.php';
    $("#confirmationModal").modal("toggle");
}

function proceed() {
    $("#confirmationModal").modal("toggle");
    fetch(path, {
        method: 'POST',
        body: data
    }).then(resp => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case 'connection':
                alertar("Error de conexión", "danger");
                break;
            case 'query':
                alertar("No se ha podido realizar la acción deseada", "danger");
                break;
            case 'ok':
                alertar("Se ha completado la acción con éxito", "success");
                setTimeout(() => {
                    window.location.reload(true);
                }, 3000);
                break;
            default:
                alertar("Error desconocido...", "warning");
                break;
        }
    });
}