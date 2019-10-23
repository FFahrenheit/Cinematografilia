var timer;
var answer = null;
var form = document.getElementById('answer');

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

function setAnswer(id, title) {
    console.log(id + title);
    answer = id;
    $("#ans").html("<p>Respuesta actual: " + title + "</p>")
}