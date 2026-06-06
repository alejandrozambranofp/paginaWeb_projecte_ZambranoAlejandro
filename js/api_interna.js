// Compruebo que la API interna de productos devuelve datos en JSON.
document.addEventListener('DOMContentLoaded', function () {
    fetch('index.php?controlador=ControladorProducto&accion=api')
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (productos) {
            var cajaApi = document.querySelector('#api_interna_resultado');

            if (cajaApi) {
                cajaApi.textContent = productos.length + ' productos cargados desde la API interna';
            }
        })
        .catch(function () {
            var cajaApi = document.querySelector('#api_interna_resultado');

            if (cajaApi) {
                cajaApi.textContent = 'No se ha podido cargar la API interna';
            }
        });
});
