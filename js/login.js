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

form.addEventListener('submit',(e)=>
{
    e.preventDefault();
    console.log('que tal');
    if(form.checkValidity())
    {
        img.src = '../../img/load.gif';   
        setTimeout(()=>
        {
            img.src = '../../img/load.jpg';
            var body = new FormData(form);
            fetch('../../php/login.php', 
            {
              method : 'POST',
              body : new FormData(form)
            }).then((response)=>
            {
              console.log(response);
                return response.json();
            }).then((resp)=>
            {
              console.log(resp);
              alert = document.getElementById('alert');
              switch(resp)
              {
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
                      setTimeout(()=>
                      {
                        window.location.pathname = 'SpoilerAlert/views/menus/index.php';
                      },1000);
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