<?php
// Controlador del carrito usando la sesion del usuario.
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

    public function anadir() {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0) {
            $producto = $this->obtenerProductoPorId($id);
            $stock = (int) ($producto['stock'] ?? 0);
            $cantidadActual = (int) ($_SESSION['carrito'][$id] ?? 0);

            if ($producto && $stock > 0 && $cantidadActual < $stock) {
                $_SESSION['carrito'][$id] = $cantidadActual + 1;
            }
        }

        header("Location: index.php");
        exit();
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;

        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }

        header("Location: index.php?controlador=ControladorCarrito&accion=ver");
        exit();
    }

    public function ver() {
        // Con los ids guardados en sesion cargo los productos completos.
        $productos_carrito = [];

        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                $producto = $this->obtenerProductoPorId($id);
                if ($producto) {
                    $productos_carrito[] = $producto;
                }
            }
        }

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