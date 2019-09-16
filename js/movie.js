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