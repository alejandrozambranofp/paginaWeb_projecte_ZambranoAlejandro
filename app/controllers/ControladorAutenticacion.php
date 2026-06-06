<?php
class ControladorAutenticacion {
    private $db;
    private $modelo;

    public function __construct($db_conn = null) {
        $this->db = $db_conn;

        if ($this->db) {
            require_once 'app/models/ModeloCliente.php';
            $this->modelo = new ModeloCliente($this->db);
        }
    }

    public function mostrarLogin() {
        $view = 'login.php';
        require_once 'app/views/inicio.php';
    }

    public function mostrarRegistro() {
        $view = 'registrar.php';
        require_once 'app/views/inicio.php';
    }

    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro');
            exit();
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if (empty($nombre) || empty($email) || empty($password)) {
            $_SESSION['error_registro'] = 'Todos los campos obligatorios deben rellenarse.';
            header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro');
            exit();
        }

        if ($password !== $password_confirm) {
            $_SESSION['error_registro'] = 'Las contrasenas no coinciden.';
            header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro');
            exit();
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $exito = $this->modelo->registrarCliente($nombre, $email, $password_hash);

        if ($exito) {
            $_SESSION['success_registro'] = 'Cuenta creada con exito. Ya puedes entrar.';
            header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin');
            exit();
        }

        $_SESSION['error_registro'] = 'Hubo un error al crear la cuenta. Es posible que el correo ya este registrado.';
        header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro');
        exit();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin');
            exit();
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $cliente = $this->modelo->obtenerClientePorEmail($email);

        if ($cliente && password_verify($password, $cliente['password'])) {
            $_SESSION['usuario_logueado'] = [
                'id_cliente' => $cliente['id_cliente'],
                'nombre' => $cliente['nombre'],
                'email' => $cliente['email'],
                'rol' => $cliente['rol']
            ];

            header('Location: index.php');
            exit();
        }

        $_SESSION['error_login'] = 'Credenciales incorrectas.';
        header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin');
        exit();
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>