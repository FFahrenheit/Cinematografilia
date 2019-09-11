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
            
        }, 500);
    }
});