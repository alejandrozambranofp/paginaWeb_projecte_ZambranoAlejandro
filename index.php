<?php
//index.php

// 1. Iniciamos la sesión para gestionar el acceso de usuarios
session_start();

// 2. Cargamos la conexión a la Base de Datos (Modelo)
require_once 'app/models/BaseDeDatos.php';
$db = BaseDeDatos::obtenerConexion();

// 3. Determinamos qué controlador y qué acción (función) ejecutar
// Si no se especifica nada en la URL, cargamos ControladorProducto por defecto
$nombreControlador = isset($_GET['controlador']) ? $_GET['controlador'] : 'ControladorProducto';
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

// 4. Definimos la ruta del archivo del controlador
$archivoControlador = 'app/controllers/' . $nombreControlador . '.php';

// 5. Carga dinámica del archivo y ejecución de la lógica
if (file_exists($archivoControlador)) {
    require_once $archivoControlador;

    // Verificamos que la clase exista dentro del archivo
    if (class_exists($nombreControlador)) {
        
        // Creamos el objeto del controlador pasándole la conexión a la base de datos
        // Esto evita el error de "Too few arguments"
        $controlador = new $nombreControlador($db);

        // Verificamos que la función (acción) exista dentro del controlador
        if (method_exists($controlador, $accion)) {
            $controlador->$accion();
        } else {
            // Si la función no existe, redirigimos al inicio por defecto
            header("Location: index.php");
            exit();
        }
    } else {
        die("Error: La clase $nombreControlador no está definida en el archivo.");
    }
} else {
    // Si el archivo físico no existe en la carpeta controllers
    die("Error: No se ha encontrado el archivo $archivoControlador.");
}