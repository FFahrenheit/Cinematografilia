var friend;

$(document).ready(() => {
    var objDiv = document.getElementById("sohbet");
    objDiv.scrollTop = objDiv.scrollHeight;
    window.setInterval(function getMessages() {
        $.ajax({
                url: '/spoileralert/php/get-chat.php',
                type: 'POST',
                datatype: 'html',
                data: { friend: friend }
            })
            .done((r) => {
                $("#sohbet").html(r);
            })
    }, 1500);
})

function setFriend(f) {
    console.log("Friend set to: " + f);
    friend = f;
}

$("#send").on('submit', (e) => {
    e.preventDefault();
    console.log("try");
    var data = new FormData(document.getElementById('send'));
    data.append("friend", friend);
    if (document.getElementById('send').checkValidity()) {
        console.log("did I?");
        $("#send").trigger("reset");
        fetch('../../php/new-message.php', {
            method: 'POST',
            body: data
        }).then(resp => {
            return resp.json();
        }).then(r => {
            if (r == 'ok') {
                getMessages();
            } else {
                window.location.reload(true);
            }
        })
    }
});