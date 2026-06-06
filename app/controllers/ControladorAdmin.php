<?php
// Controlador del panel de administracion.

require_once 'app/models/ModeloAdmin.php';

class ControladorAdmin {
    private $db;
    private $modelo;

    public function __construct($db_conn) {
        $this->db = $db_conn;
        $this->modelo = new ModeloAdmin($this->db);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function comprobarAdmin() {
        if (!isset($_SESSION['usuario_logueado']) || ($_SESSION['usuario_logueado']['rol'] ?? '') !== 'admin') {
            header("Location: index.php");
            exit();
        }
    }

    public function panel() {
        $this->comprobarAdmin();

        $filtros = [
            'usuario' => trim($_GET['usuario'] ?? ''),
            'fecha' => trim($_GET['fecha'] ?? ''),
            'orden' => trim($_GET['orden'] ?? 'fecha_desc')
        ];

        $pedidos = $this->modelo->obtenerPedidos($filtros);
        $productos = $this->modelo->obtenerProductos();
        $logs = $this->modelo->obtenerLogs();

        $view = 'admin_panel.php';
        require_once 'app/views/inicio.php';
    }

    public function crearProducto() {
        $this->comprobarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'precio' => (float) ($_POST['precio'] ?? 0),
                'imagen' => trim($_POST['imagen'] ?? 'logo_header.png'),
                'categoria' => trim($_POST['categoria'] ?? 'Postres'),
                'stock' => (int) ($_POST['stock'] ?? 0),
                'oferta' => isset($_POST['oferta']) ? 1 : 0,
                'franquicia' => trim($_POST['franquicia'] ?? '')
            ];

            if ($datos['nombre'] !== '' && $datos['precio'] > 0) {
                $this->modelo->crearProducto($datos);
                $this->modelo->registrarLog(
                    $_SESSION['usuario_logueado']['email'],
                    "Producto creado: " . $datos['nombre']
                );
            }
        }

        header("Location: index.php?controlador=ControladorAdmin&accion=panel");
        exit();
    }

    public function actualizarProducto() {
        $this->comprobarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'id_producto' => (int) ($_POST['id_producto'] ?? 0),
                'nombre' => trim($_POST['nombre'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'precio' => (float) ($_POST['precio'] ?? 0),
                'imagen' => trim($_POST['imagen'] ?? 'logo_header.png'),
                'categoria' => trim($_POST['categoria'] ?? 'Postres'),
                'stock' => (int) ($_POST['stock'] ?? 0),
                'oferta' => isset($_POST['oferta']) ? 1 : 0,
                'franquicia' => trim($_POST['franquicia'] ?? '')
            ];

            if ($datos['id_producto'] > 0 && $datos['nombre'] !== '' && $datos['precio'] > 0) {
                $this->modelo->actualizarProducto($datos);
                $this->modelo->registrarLog(
                    $_SESSION['usuario_logueado']['email'],
                    "Producto actualizado con ID " . $datos['id_producto']
                );
            }
        }

        header("Location: index.php?controlador=ControladorAdmin&accion=panel");
        exit();
    }

    public function eliminarProducto() {
        $this->comprobarAdmin();

        $id_producto = (int) ($_GET['id'] ?? 0);

        if ($id_producto > 0) {
            $eliminado = $this->modelo->eliminarProducto($id_producto);

            if ($eliminado) {
                $_SESSION['success_admin'] = "Producto eliminado correctamente.";
                $this->modelo->registrarLog(
                    $_SESSION['usuario_logueado']['email'],
                    "Producto eliminado con ID " . $id_producto
                );
            } else {
                $_SESSION['error_admin'] = "No se puede eliminar un producto que ya aparece en pedidos. Puedes poner su stock a 0 si no quieres venderlo.";
            }
        }

        header("Location: index.php?controlador=ControladorAdmin&accion=panel");
        exit();
    }

    public function actualizarPedido() {
        $this->comprobarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pedido = (int) ($_POST['id_pedido'] ?? 0);
            $estado = trim($_POST['estado'] ?? 'Confirmado');

            if ($id_pedido > 0) {
                $this->modelo->actualizarEstadoPedido($id_pedido, $estado);
                $this->modelo->registrarLog(
                    $_SESSION['usuario_logueado']['email'],
                    "Estado actualizado del pedido ID " . $id_pedido . " a " . $estado
                );
            }
        }

        header("Location: index.php?controlador=ControladorAdmin&accion=panel");
        exit();
    }
}
?>