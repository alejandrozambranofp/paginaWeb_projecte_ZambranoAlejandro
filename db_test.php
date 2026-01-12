<?php
//db_test.php
require_once 'app/models/BaseDeDatos.php';

echo "<h1>Test de Conexión a la Base de Datos</h1>";

try {
    $conn = BaseDeDatos::obtenerConexion();
    
    echo "<p style='color: green; font-weight: bold;'>ÉXITO: Conexión establecida correctamente con la base de datos 'sweet_kingdom'.</p>";
    
    echo "<p>Versión del servidor: " . $conn->getAttribute(PDO::ATTR_SERVER_VERSION) . "</p>";

} catch (Exception $e) {
    echo "<p style='color: red; font-weight: bold;'>ERROR: Falló la conexión.</p>";
    echo "<p>Detalle del error: " . $e->getMessage() . "</p>";
}

?>