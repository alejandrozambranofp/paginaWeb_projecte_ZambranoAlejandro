// Anade productos al carrito sin recargar la pagina.
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.boton_anadir_home').forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();

            fetch(boton.href, { credentials: 'same-origin' })
                .then(function () {
                    boton.classList.add('boton_anadido');
                    setTimeout(function () {
                        boton.classList.remove('boton_anadido');
                    }, 450);
                });
        });
    });
});