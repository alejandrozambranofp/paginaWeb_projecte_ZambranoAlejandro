<?php
/**
 * ControladorCarrito.php
 * Gestiona las operaciones del carrito de la compra usando sesiones.
 */

class ControladorCarrito {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    /**
     * Añade un producto al carrito
     */
    public function añadir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            if (isset($_SESSION['carrito'][$id])) {
                $_SESSION['carrito'][$id]++;
            } else {
                $_SESSION['carrito'][$id] = 1;
            }
        }
        header("Location: index.php");
        exit();
    }

    /**
     * Elimina una unidad o el producto del carrito
     */
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
        header("Location: index.php?controlador=ControladorCarrito&accion=ver");
        exit();
    }

    /**
     * Muestra la vista del carrito con los datos de la DB
     */
    public function ver() {
        require_once 'app/models/ModeloProducto.php';
        $productos_carrito = [];
        
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                $p = $this->obtenerProductoPorId($id); 
                if ($p) {
                    $productos_carrito[] = $p;
                }
            }
        }

        // El layout espera la variable $view
        $view = 'carrito_detalle.php';
        require_once 'app/views/inicio.php';
    }

    public function vaciar() {
        $_SESSION['carrito'] = [];
        header("Location: index.php?controlador=ControladorCarrito&accion=ver");
        exit();
    }

    private function obtenerProductoPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>