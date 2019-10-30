var timer;
var answer = null;
var form = document.getElementById('answer');
var last;

function searche() {
    search();
}

if (form != null) {
    form.addEventListener('submit', e => {
        e.preventDefault();
        if (answer == null) {
            alertar("Seleccione una película de la lista marcando el cuadro", "danger");
        } else {
            var data = new FormData();
            data.append("movie", answer);
            fetch('../../php/send-answer.php', {
                method: 'POST',
                body: data
            }).then(resp => {
                return resp.json();
            }).then(r => {
                console.log(r);
                switch (r) {
                    case '0':
                        alertar("Error interno", "danger");
                        break;
                    case '1':
                        alertar("No se ha podido enviar la respuesta", "danger");
                        break;
                    case '2':
                        alertar("Respuesta enviada", "success");
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 2500);
                        break;
                }
            });
        }
    })
}

function search() {
    console.log("Hola");
    clearTimeout(timer);
    timer = setTimeout(() => {
        console.log("Buscar");
        var name = document.getElementById('name').value;
        console.log(name);
        $.ajax({
                url: '/spoileralert/php/get-search.php',
                type: 'POST',
                datatype: 'html',
                data: { search: name }
            })
            .done((r) => {
                $("#answers").html(r);
                console.log(r);
            })
    }, 1000);
}

function setAnswer(id, title, reference) {
    if (last == reference && answer == id) {
        console.log("Desmarcar");
        last.innerHTML = '<i class="far fa-square"></i>';
        answer = null;
        $("#ans").html("<p>Seleccione una respuesta</p>");
    } else {
        console.log(id + title);
        answer = id;
        $("#ans").html("<p>Respuesta actual: " + title + "</p>");
        console.log("A ver si jaló");
        if (last != null) {
            last.innerHTML = '<i class="far fa-square"></i>';
        }
        reference.innerHTML = '<i class="far fa-check-square"></i>';
        last = reference;
    }
}

// function reference(reference) {
//     console.log("Referencia a i");
//     reference.className = "";
//     reference.classList.add("far");
//     reference.classList.add("fa-check-square");
// }

// $("i").click(() => {
//     console.log("Hola");
// });

// $("i").click(() => {
//     console.log("Adios");
// })