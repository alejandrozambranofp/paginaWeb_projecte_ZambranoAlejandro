// assets/js/api_interna.js

// Esperamos a que la web cargue
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Llamamos a TU propia API (El camarero de tu casa)
    fetch('index.php?controlador=ControladorProducto&accion=api')
        .then(response => response.json()) // Convertimos la respuesta a JSON
        .then(data => {
            console.log("=== API INTERNA (Tus Productos) ===");
            console.log("El servidor me ha enviado " + data.length + " productos.");
            console.log(data); // Muestra todos los productos en la consola
            
            // Opcional: Mostrar un aviso visual para el profe
            // alert('API Interna cargada: Hay ' + data.length + ' productos en base de datos.');
        })
        .catch(error => console.error('Error en API Interna:', error));
});