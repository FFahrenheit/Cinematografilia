(function() {
    'use strict';

    window.addEventListener('load', function() {
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

var form = document.getElementById('formulario');
var img = document.getElementById('load');
var recover = document.getElementById('recover');

if (recover != null) {
    recover.addEventListener('submit', (e) => {
        e.preventDefault();
        console.log("Recuperar");
        alertar("Enviando solicitud...", "warning");
        if (recover.checkValidity()) {
            fetch('../../php/recover.php', {
                method: 'POST',
                body: new FormData(recover)
            }).then(resp => {
                return resp.json();
            }).then(r => {
                console.log(r);
                switch (r) {
                    case '1':
                    case '4':

                        alertar("Error de conexión", "danger");
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 1500);
                        break;
                    case '2':
                        alertar("No encontramos la cuenta asociada al nombre de usuario", "warning");
                        break;
                    case '3':
                        alertar("No hemos podido enviar el correo a la dirección especificada", "danger");
                        break;
                    case '5':
                        alertar("Hemos enviado correo a la dirección asociada a tu cuenta para recuperar tu contraseña", "success");
                        break;
                    default:
                        alertar("Error con el servidor", "danger");
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 1500);
                }
            })
        }
    })
}

if (form != null) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        console.log('que tal');
        if (form.checkValidity()) {
            img.src = '../../img/load.gif';
            setTimeout(() => {
                img.src = '../../img/load.jpg';
                var body = new FormData(form);
                fetch('../../php/login.php', {
                    method: 'POST',
                    body: new FormData(form)
                }).then((response) => {
                    console.log(response);
                    return response.json();
                }).then((resp) => {
                    console.log(resp);
                    alert = document.getElementById('alert');
                    switch (resp) {
                        case '1':
                            alert.classList.add('alert-danger');
                            alert.innerHTML = 'Error interno del servidor';
                            break;
                        case '2':
                            alert.classList.add('alert-danger');
                            alert.innerHTML = 'Error del servidor';
                            break;
                        case '3':
                            alert.classList.add('alert-danger');
                            alert.innerHTML = 'Usuario o contraseña incorrectas';
                            form.reset();
                            break;
                        case '4':
                            alert.classList.add('alert-success');
                            alert.innerHTML = 'Inicio correcto... Redirigiendo';
                            setTimeout(() => {
                                window.location.pathname = 'SpoilerAlert/views/menus/index.php';
                            }, 1000);
                            break;
                        case '5':
                            alert.classList.add('alert-success');
                            alert.innerHTML = 'Cuenta recuperada, te recomendamos cambiar tu contraseña ya que esta exiró, redirigiendo...';
                            setTimeout(() => {
                                window.location.pathname = 'SpoilerAlert/views/menus/configure.php';
                            }, 2500);
                            break;
                        default:
                            alert.classList.add('alert-danger');
                            alert.innerHTML = 'Error desconocido. Intente de nuevo';
                            break;
                    }
                    console.log('End');
                });
            }, 500);
        }
    });
}