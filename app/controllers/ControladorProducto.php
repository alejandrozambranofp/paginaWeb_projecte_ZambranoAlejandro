<?php
require_once 'app/models/ModeloProducto.php';

class ControladorProducto {
    private $modelo;
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
        $this->modelo = new ModeloProducto($this->db);
    }

    public function index() {
        $productos = $this->modelo->obtenerTodos();
        $view = 'home.php';
        require_once 'app/views/inicio.php';
    }

    public function listar() {
        // Recojo los filtros del formulario del catalogo.
        $filtros = [
            'franquicia' => $_GET['franquicia'] ?? null,
            'orden' => $_GET['orden'] ?? null,
            'ofertas' => isset($_GET['ofertas']) ? 1 : null,
            'agotados' => isset($_GET['agotados']) ? 1 : null,
            'tipo' => $_GET['tipo'] ?? null,
            'rango_precio' => $_GET['rango_precio'] ?? null
        ];

        $productos = $this->modelo->obtenerProductosFiltrados($filtros);
        $view = 'productos.php';
        require_once 'app/views/inicio.php';
    }

    public function categoria() {
        $cat = $_GET['tipo'] ?? '';

        if ($cat == 'Todos' || empty($cat)) {
            $productos = $this->modelo->obtenerTodos();
        } else {
            $productos = $this->modelo->obtenerPorCategoria($cat);
        }

        $view = 'productos.php';
        require_once 'app/views/inicio.php';
    }

    public function ver() {
        $id = (int) ($_GET['id'] ?? 0);
        $producto = $this->modelo->obtenerPorId($id);

        if (!$producto) {
            header('Location: index.php?controlador=ControladorProducto&accion=listar');
            exit();
        }

        $view = 'producto_detalle.php';
        require_once 'app/views/inicio.php';
    }

    public function buscar() {
        $termino = isset($_GET['termino']) ? trim($_GET['termino']) : '';

        if (!empty($termino)) {
            $productos = $this->modelo->buscarProductos($termino);
        } else {
            $productos = $this->modelo->obtenerTodos();
        }

        $view = 'productos.php';
        require_once 'app/views/inicio.php';
    }

    public function franquicias() {
        // Creo los bloques que se ven en la pagina de franquicias.
        $nombresFranquicias = ['Mario', 'Zelda', 'Kirby', 'Animal Crossing', 'Pokemon', 'Donkey Kong', 'Metroid'];
        $franquicias = [];

        foreach ($nombresFranquicias as $nombre) {
            $productos = $this->modelo->obtenerPorFranquicia($nombre);
            if (!empty($productos)) {
                $franquicias[$nombre] = $productos;
            }
        }

        $view = 'franquicias.php';
        require_once 'app/views/inicio.php';
    }

    public function especiales() {
        $productos = $this->modelo->obtenerEspeciales();
        $view = 'especiales.php';
        require_once 'app/views/inicio.php';
    }

    public function masComprado() {
        $productos = $this->modelo->obtenerMasComprados();
        $view = 'mas_comprado.php';
        require_once 'app/views/inicio.php';
    }

    public function novedades() {
        $productos = $this->modelo->obtenerNovedades();
        $view = 'novedades.php';
        require_once 'app/views/inicio.php';
    }

    public function api() {
        // API interna usada para devolver los productos en formato JSON.
        $productos = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($productos);
        exit;
    }
}
?>