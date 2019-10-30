$("#alert").hide();

function alertar(message, type) {
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    var cls = 'alert alert-' + type;
    var al = document.getElementById('alert');
    var alT = document.getElementById('alert-message');
    al.removeAttribute("class");
    al.classList.add(cls);
    alT.innerHTML = message;
    $("#alert").show();
}