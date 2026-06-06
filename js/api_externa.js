// Cargo una API externa para mostrar el cambio aproximado de EUR a USD.
document.addEventListener('DOMContentLoaded', function () {
    var cajaApi = document.querySelector('#api_externa_resultado');

    if (!cajaApi) {
        return;
    }

    fetch('https://api.frankfurter.app/latest?from=EUR&to=USD')
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {
            if (datos.rates && datos.rates.USD) {
                cajaApi.textContent = 'API externa: 1 EUR son ' + datos.rates.USD.toFixed(2) + ' USD';
            } else {
                cargarApiReserva(cajaApi);
            }
        })
        .catch(function () {
            cargarApiReserva(cajaApi);
        });
});

function cargarApiReserva(cajaApi) {
    fetch('https://open.er-api.com/v6/latest/EUR')
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {
            if (datos.rates && datos.rates.USD) {
                cajaApi.textContent = 'API externa: 1 EUR son ' + datos.rates.USD.toFixed(2) + ' USD';
            } else {
                cajaApi.textContent = 'No se ha podido cargar la API externa';
            }
        })
        .catch(function () {
            cajaApi.textContent = 'No se ha podido cargar la API externa';
        });
}