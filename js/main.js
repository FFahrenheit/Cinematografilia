$(document).ready(()=>
{
    console.log("Hola");
    $("#footer").html('<footer class="page-footer font-small teal pt-4 sa_footer">'
    +'<div class="container-fluid text-center text-md-left">'
      +'<div class="row">'
        +'<div class="col-md-6 mt-md-0 mt-3">'
          +'<h5 class="text-uppercase font-weight-bold">Políticas</h5>'
          +'<p>SpoilerAltert! mantiene segura toda tu información personal y no '
              +'la provee a terceros ni hace uso de esta para otros fines. \n'
              +'SpoilerAlert! requiere que su comunidad tenga un nivel de inglés básico para'
              +' su correcto uso.'
          +'</p>'
        +'</div>'
        +'<hr class="clearfix w-100 d-md-none pb-3">'
        +'<div class="col-md-6 mb-md-0 mb-3">'
          +'<h5 class="text-uppercase font-weight-bold">Nosotros</h5>'
          +'<p>SpoilerAltert! es una red social para los amantes del cine '
              +'que desean compartir sus gustos, así como llevar el récord '
              +'de las películas que ven y compartirlo con la comunidad.'
          +'</p>'
        +'</div>'
      +'</div>'
    +'</div>'
    +'<div class="footer-copyright text-center py-3">© 2019 Copyright'
    +'</div>'
  +'</footer>')
    console.log("Page succesfully loaded");
});