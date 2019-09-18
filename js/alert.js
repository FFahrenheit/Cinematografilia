$("#alert").hide();

function alertar(message, type) {
    var cls = 'alert-' + type;
    var al = document.getElementById('alert');
    var alT = document.getElementById('alert-message');
    al.classList.add(cls);
    alT.innerHTML = message;
    $("#alert").show();
}