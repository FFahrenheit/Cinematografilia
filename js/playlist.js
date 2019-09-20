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
    e.preventDefault();
    var ok = false;
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
            }
        })
    }
    if (!ok) {
        alertar("Error desconocido", "danger");
        setTimeout(() => {
            window.location.reload(true);
        }, 3000);
    }
});