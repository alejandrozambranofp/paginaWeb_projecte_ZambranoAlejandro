<?php
// Controlador del perfil de usuario.
require_once 'app/models/ModeloCliente.php';

class ControladorUsuario {
    private $db;
    private $modelo;

    public function __construct($db_conn) {
        $this->db = $db_conn;
        $this->modelo = new ModeloCliente($this->db);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function comprobarSesion() {
        if (!isset($_SESSION['usuario_logueado'])) {
            header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin");
            exit();
        }
    }

    public function perfil() {
        $this->comprobarSesion();

        $id_cliente = $_SESSION['usuario_logueado']['id_cliente'];

        $cliente = $this->modelo->obtenerClientePorId($id_cliente);
        $pedidos = $this->modelo->obtenerPedidosCliente($id_cliente);

        $detallesPedidos = [];
        foreach ($pedidos as $pedido) {
            $detallesPedidos[$pedido['id_pedido']] = $this->modelo->obtenerDetallePedido(
                $pedido['id_pedido'],
                $id_cliente
            );
        }

        $view = 'perfil_usuario.php';
        require_once 'app/views/inicio.php';
    }

    public function actualizar() {
        $this->comprobarSesion();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controlador=ControladorUsuario&accion=perfil");
            exit();
        }

        $id_cliente = $_SESSION['usuario_logueado']['id_cliente'];
        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($nombre) || empty($email)) {
            $_SESSION['error_perfil'] = "El nombre y el email son obligatorios.";
            header("Location: index.php?controlador=ControladorUsuario&accion=perfil");
            exit();
        }

        $actualizado = $this->modelo->actualizarCliente($id_cliente, $nombre, $email, $password);

        if ($actualizado) {
            $_SESSION['usuario_logueado']['nombre'] = $nombre;
            $_SESSION['usuario_logueado']['email'] = $email;
            $_SESSION['success_perfil'] = "Tus datos se han actualizado correctamente.";
        } else {
            $_SESSION['error_perfil'] = "No se han podido actualizar tus datos.";
        }

        header("Location: index.php?controlador=ControladorUsuario&accion=perfil");
        exit();
    }
}
?>