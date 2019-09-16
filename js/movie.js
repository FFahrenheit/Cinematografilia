function addToFavorite(movie) {
    data = new FormData();
    console.log(movie);
    data.append("movie", movie);
    fetch('../../php/add-favorite.php', {
        method: 'POST',
        body: data
    }).then((resp) => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de sesión", "danger")
                break;
            case '1':
                alertar("Error de conexión", "danger");
                break;
            case '2':
                alertar("La película ya está en favoritos", "warning");
                break;
            case '3':
                alertar("Película agregada", "success");
                break;
        }
    });
}

function addToWatchlist(movie) {
    console.log("Movie: " + movie);
    data = new FormData();
    data.append("movie", movie);
    fetch('../../php/add-watchlist.php', {
        method: 'POST',
        body: data
    }).then((resp) => {
        return resp.json();
    }).then(r => {
        console.log(r);
        switch (r) {
            case '0':
                alertar("Error de sesión", "danger")
                break;
            case '1':
                alertar("Error de conexión", "danger");
                break;
            case '2':
                alertar("La película ya está en la lista de películas por ver", "warning");
                break;
            case '3':
                alertar("La película ya se encuentra en la lista de vistas", "warning");
                break;
            case '4':
                alertar("Película agregada", "success");
                break;
        }
    });
}