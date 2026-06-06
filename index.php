<?php
// Punto de entrada de la aplicacion.
session_start();

require_once 'app/models/BaseDeDatos.php';
$db = BaseDeDatos::obtenerConexion();

$nombreControlador = $_GET['controlador'] ?? 'ControladorProducto';
$accion = $_GET['accion'] ?? 'index';
$archivoControlador = 'app/controllers/' . $nombreControlador . '.php';

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;

    if (class_exists($nombreControlador)) {
        $controlador = new $nombreControlador($db);

        if (method_exists($controlador, $accion)) {
            $controlador->$accion();
        } else {
            header('Location: index.php');
            exit();
        }
    } else {
        die('Error: la clase del controlador no existe.');
    }
} else {
    die('Error: no se ha encontrado el controlador.');
}
?>