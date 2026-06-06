<?php
// Conexion principal a la base de datos.
class BaseDeDatos {
    private static $conexion = null;
    private static $host = "localhost";
    private static $usuario = "root";
    private static $contrasena = "";
    private static $nombre_bd = "sweet_kingdom";

    public static function obtenerConexion() {
        if (self::$conexion === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$nombre_bd . ";charset=utf8";
                self::$conexion = new PDO($dsn, self::$usuario, self::$contrasena);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexion a la base de datos: " . $e->getMessage());
            }
        }

        return self::$conexion;
    }
}
?>
