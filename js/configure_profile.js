(function () {
  'use strict';
  window.addEventListener('load', function () {
    var form = document.getElementById('image-change');
    form.addEventListener('submit', function (event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();

(function () {
  'use strict';
  window.addEventListener('load', function () {
    var form = document.getElementById('password-change');
    form.addEventListener('submit', function (event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();


var imgForm = document.getElementById('image-change');
var img = document.getElementById('image');
var alerta = document.getElementById('alert');

imgForm.addEventListener('submit', e => {
  e.preventDefault();
  if (imgForm.checkValidity()) {
    console.log("Hola");
    if ((/\.(gif|jpg|jpeg|tiff|png)$/i).test(img.value)) {
      console.log("Valido");
      var data = new FormData(imgForm);
      fetch('../../php/image-change.php',
        {
          method: 'POST',
          body: data
        }).then(resp => {
          console.log(resp);
          return resp.json();
        }).then(r => {
          console.log(r);
          alerta.classList.add('alert-danger');
          switch (r) {
            case '0':
              alerta.innerHTML = 'Error de conexión';
              return;
            case '1':
              alerta.innerHTML = 'Error con la imagen';
              return;
            case '2':
              alerta.innerHTML = 'Error con la sesión';
              setInterval(() => {
                window.location.reload(true);
              }, 1500);

            case '3':
              alerta.innerHTML = 'Error al subir imagen';
              return;
          }
        })
      alerta.classList.add('alert-success');
      alerta.innerHTML = 'Imagen cambiada, regresando...';
      setInterval(() => {
        window.location.reload(true);
      }, 1500);
    }
    else {
      alert("El formato no es válido");
    }
  }
});

var passForm = document.getElementById('password-change');

passForm.addEventListener('submit',e=>
{
  e.preventDefault();
  if(passForm.checkValidity())
  {
    var data = new FormData(passForm);
    fetch('../../php/change-password.php',
    {
      method:'POST',
      body:data
    }).then(resp=>
      {
        return resp.json();
      }).then(r=>
        {
          console.log(r);
          switch(r)
          {
            case '0':
              alert("Error de conexión");
              break;
            case '1':
              alert('Error en consulta');
              break;
            case '2':
              alert('Contraseña incorrecta');
              passForm.reset();
              break;
            case '3':
              alert("La nueva contraseña no puede ser igual a la actual");
              passForm.reset();
              break;
            case '4':
              alert("Error al actualizar contraseña");
              break;
              case '5':
                alert("Contraseña actualizada");
                window.location.reload(true);

          }
        })
  }
});
