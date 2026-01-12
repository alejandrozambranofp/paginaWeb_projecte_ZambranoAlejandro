<?php
/**
 * app/controllers/ControladorProducto.php
 */

require_once 'app/models/ModeloProducto.php';

class ControladorProducto {
    private $modelo;
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
        $this->modelo = new ModeloProducto($this->db);
    }

    // Home normal (Carrusel + destacados)
    public function index() {
        $productos = $this->modelo->obtenerTodos();
        $view = 'home.php';
        require_once 'app/views/inicio.php';
    }

    // --- ESTA ES LA FUNCIÓN NUEVA QUE NECESITAS ---
    public function listar() {
        // 1. Recogemos todos los filtros del formulario HTML
        $filtros = [
            'franquicia'   => $_GET['franquicia'] ?? null,
            'orden'        => $_GET['orden'] ?? null,
            'ofertas'      => isset($_GET['ofertas']) ? 1 : null,
            'agotados'     => isset($_GET['agotados']) ? 1 : null,
            'tipo'         => $_GET['tipo'] ?? null,
            'rango_precio' => $_GET['rango_precio'] ?? null
        ];

        // 2. Llamamos a la nueva función del modelo que acabamos de crear
        $productos = $this->modelo->obtenerProductosFiltrados($filtros);
        
        // 3. Cargamos la vista
        $view = 'productos.php'; 
        require_once 'app/views/inicio.php';
    }
    // ----------------------------------------------

    // Filtros de categoría
    public function categoria() {
        $cat = $_GET['tipo'] ?? '';
        if ($cat == 'Todos' || empty($cat)) {
            $productos = $this->modelo->obtenerTodos();
        } else {
            $productos = $this->modelo->obtenerPorCategoria($cat);
        }
        // Si quieres ver solo la lista filtrada, usa productos.php aquí también
        $view = 'productos.php'; 
        require_once 'app/views/inicio.php';
    }

    // Buscador
    public function buscar() {
        $termino = isset($_GET['termino']) ? trim($_GET['termino']) : '';
        if (!empty($termino)) {
            $productos = $this->modelo->buscarProductos($termino);
        } else {
            $productos = $this->modelo->obtenerTodos();
        }
        $view = 'productos.php'; // Mostrar resultados en lista
        require_once 'app/views/inicio.php';
    }
    public function api() {
        // 1. Obtenemos todos los productos de la BD
        $productos = $this->modelo->obtenerTodos();
        
        // 2. Avisamos al navegador que esto son datos JSON, no una web normal
        header('Content-Type: application/json');
        
        // 3. Imprimimos los datos convertidos a texto JSON
        echo json_encode($productos);
        exit; // Detenemos el script para que no cargue el footer ni nada más
    }
}
?>