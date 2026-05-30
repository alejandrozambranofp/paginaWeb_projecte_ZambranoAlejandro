<?php
/**ControladorAutenticacion.php */
class ControladorAutenticacion {
    private $db;
    private $modelo; 

    public function __construct($db_conn = null) {
        $this->db = $db_conn;
        
        // Cargamos el modelo necesario para interactuar con la tabla 'cliente'
        if ($this->db) {
            require_once 'app/models/ModeloCliente.php';
            $this->modelo = new ModeloCliente($this->db);
        }
    }

    public function mostrarLogin() {
        require_once 'app/views/header.php';
        require_once 'app/views/login.php';
    }

    public function mostrarRegistro() {
        require_once 'app/views/header.php';
        require_once 'app/views/registrar.php';
    }

    /**
     * Procesa el formulario de registro y guarda en la base de datos
     * Ajustado a campos: nombre, email, password (id_cliente es autoincremental)
     */
    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Recoger datos del formulario (Se elimina 'apellidos' según estructura de tabla)
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            // 2. Validaciones básicas
            if (empty($nombre) || empty($email) || empty($password)) {
                $_SESSION['error_registro'] = "Todos los campos obligatorios deben rellenarse.";
                header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro");
                exit();
            }

            if ($password !== $password_confirm) {
                $_SESSION['error_registro'] = "Las contraseñas no coinciden.";
                header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro");
                exit();
            }

            // 3. Cifrar la contraseña por seguridad
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // 4. Intentar guardar en la base de datos a través del modelo
            // Solo pasamos nombre, email y password_hash. El id_cliente es automático en la DB.
            $exito = $this->modelo->registrarCliente($nombre, $email, $password_hash);

            if ($exito) {
                // Registro correcto
                $_SESSION['success_registro'] = "¡Cuenta creada con éxito! Ya puedes entrar.";
                header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin");
                exit();
            } else {
                // Error (probablemente email duplicado)
                $_SESSION['error_registro'] = "Hubo un error al crear la cuenta. Es posible que el correo ya esté registrado.";
                header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro");
                exit();
            }
        } else {
            header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro");
            exit();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            } else {
                $_SESSION['error_login'] = "Credenciales incorrectas.";
                header('Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin');
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}