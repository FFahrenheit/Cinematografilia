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