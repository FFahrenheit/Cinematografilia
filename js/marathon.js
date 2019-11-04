var marathonForm = document.getElementById('new-marathon');


(function() {
    'use strict';
    var form = marathonForm;
    window.addEventListener('load', function() {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }, false);
})();

marathonForm.addEventListener('submit', (e) => {
    e.preventDefault();
    if (checkDates() && marathonForm.checkValidity) {
        console.log("Ola");
    }
});

function goTop() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
}

function checkDates() {
    var currentDate = new Date();
    // console.log(current);
    // var currentDate = new Date(current.getFullYear(), current.getMonth() + 1, current.getDay());
    currentDate.setHours(0, 0, 0, 0);
    var beginDate = new Date($('#begin').val().replace('-', '/')); //Some javascript buggy shit 
    beginDate.setHours(0, 0, 0, 0);
    var endDate = new Date($('#end').val().replace('-', '/'));
    endDate.setHours(0, 0, 0, 0);
    console.log(currentDate + beginDate + endDate);
    var difference = (beginDate - currentDate) / (1000 * 60 * 60 * 24);
    console.log(difference);
    if (difference >= 3 && difference <= 30) {
        difference = (endDate - beginDate) / (1000 * 60 * 60 * 24);
        if (difference >= 2 && difference <= 15) {
            return true;
        } else {
            alertar("Los maratones deben durar entre 2 y 15 días, este dura " + difference + " días", "warning");
            goTop();
            return false;
        }

    } else {
        alertar("Los maratones deben empezar entre 3 y 30 días, este empieza en " + difference + " días", "warning");
        goTop();
        return false;
    }
}