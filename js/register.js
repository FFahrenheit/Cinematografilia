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

function checkPassword()
{
    var pass = document.getElementById('pass');
    var cPass = document.getElementById('cPass');
    var span = document.getElementById('passwordError');
    if(cPass.value == pass.value)
    {
        span.style.color = 'green';
        span.innerHTML = 'Ok';
    }
    else 
    {
        span.style.color = 'red';
        span.innerHTML = 'Las contraseñas no coinciden';
    }
}

function checkEmail()
{
    var email = document.getElementById("email");
    var span = document.getElementById("emailError");
    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))
    {
        span.style.color='green';
        span.innerHTML="Ok";
    }
    else 
    {
        span.style.color = 'red';
        span.innerHTML= "Correo inválido";
    }
}

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
            var data = new FormData(form);
            fetch('../../php/register.php',
            {
                method: 'POST',
                body: data
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
                        alert.innerHTML = 'Error interno del servidor. Intente de nuevo';
                        break;
                    case '2':
                        alert.classList.add('alert-warning');
                        alert.innerHTML = 'Usuario y/o correo ya registrado';
                        form.reset();
                        break;
                    case '3':
                        alert.classList.add('alert-success');
                        alert.innerHTML = '¡Éxito! Inicia sesión <a href="login.php">aquí</a>';
                        break;
                    default:
                        alert.classList.add('alert-danger');
                        alert.innerHTML = 'Error desconocido. Intente de nuevo';
                        break;
                }
                console.log('End');
            })
        }, 500);
    }
});