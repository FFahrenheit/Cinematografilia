var rText = document.getElementById('modal-body');
var rType;
var rMovie;
var rTitle = document.getElementById('exampleModalLabel');

function modal(title, text, onc) {
    console.log(onc);
    $('#okButton').removeAttr('onclick');
    $('#okButton').attr('onClick', onc);
    $('#exampleModal').modal('toggle');
    waiting = true;
    rText.innerHTML = text;
    rTitle.innerHTML = title;
}

function modToggle() {
    $('#exampleModal').modal('toggle');
}

function confirmAction() {
    waiting = false;
    accepted = true;
    $('#exampleModal').modal('toggle');
    $('html, body').animate({ scrollTop: 0 }, 'fast');
}

function cancelAction() {
    waiting = false;
    accepted = false;
}