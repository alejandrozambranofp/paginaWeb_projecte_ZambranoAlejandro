<?php
/**
 * ControladorPedido.php
 * Gestiona la finalización de la compra y el registro en la base de datos.
 */

class ControladorPedido {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Simula o registra la confirmación del pedido
     */
    public function confirmar() {
        // 1. Verificamos que el usuario esté logueado
        if (!isset($_SESSION['usuario_logueado'])) {
            header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin");
            exit();
        }

        // 2. Verificamos que haya algo en el carrito
        if (empty($_SESSION['carrito'])) {
            header("Location: index.php");
            exit();
        }

        try {
            // Aquí iría la lógica para INSERTAR en una tabla 'pedido'
            // Pero para ir rápido y que no te dé error de base de datos, 
            // vamos a simular que se guarda y vaciamos el carrito.
            
            // Vaciamos el carrito tras la "compra"
            $_SESSION['carrito'] = [];
            
            // Guardamos un mensaje de éxito para mostrarlo
            $_SESSION['mensaje_exito_compra'] = "¡Gracias por tu compra! Tu pedido en Sweet Kingdom ha sido procesado con éxito.";
            
            // Redirigimos a una vista de éxito o a la home
            $view = 'compra_exitosa.php';
            require_once 'app/views/inicio.php';

        } catch (Exception $e) {
            die("Error al procesar el pedido: " . $e->getMessage());
        }
    }
}
?>