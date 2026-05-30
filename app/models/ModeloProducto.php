<?php
/**
 * ModeloProducto.php
 * Gestiona las consultas de productos en la base de datos.
 */

class ModeloProducto {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    /**
     * Obtiene todos los productos
     */
    public function obtenerTodos() {
        $stmt = $this->db->prepare("SELECT * FROM producto");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene productos por categoría
     */
    public function obtenerPorCategoria($categoria) {
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE categoria = ?");
        $stmt->execute([$categoria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * BUSCADOR: Busca productos por nombre o descripción
     */
    public function buscarProductos($termino) {
        $sql = "SELECT * FROM producto WHERE nombre LIKE :termino OR descripcion LIKE :termino";
        $stmt = $this->db->prepare($sql);
        $t = "%" . $termino . "%";
        $stmt->bindParam(':termino', $t);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * NUEVA FUNCIÓN: FILTRO AVANZADO (Para el sidebar)
     * Recibe un array con las opciones seleccionadas
     */
    public function obtenerProductosFiltrados($filtros) {
        $sql = "SELECT * FROM producto WHERE 1=1";
        $params = [];

        // --- Filtro por Franquicia ---
        // Si te da error aquí también, es que no tienes columna 'franquicia'
        if (!empty($filtros['franquicia'])) {
            $sql .= " AND franquicia = :franquicia";
            $params[':franquicia'] = $filtros['franquicia'];
        }

        // --- Filtro por Tipo ---
        if (!empty($filtros['tipo'])) {
            $sql .= " AND categoria = :categoria";
            $params[':categoria'] = $filtros['tipo'];
        }

        // --- Filtro de Ofertas (CORREGIDO) ---
        if (!empty($filtros['ofertas'])) {
            $sql .= " AND oferta = 1";
        }

        // --- Filtro de Agotados ---
        // Asumo que tienes una columna 'stock'. Si no, comenta esto también.
        if (!empty($filtros['agotados'])) {
             $sql .= " AND stock > 0";
        }

        // --- Filtro de Rango de Precio ---
        if (!empty($filtros['rango_precio'])) {
            $rango = explode('-', $filtros['rango_precio']);
            if (count($rango) === 2) {
                $sql .= " AND precio >= :min AND precio <= :max";
                $params[':min'] = $rango[0];
                $params[':max'] = $rango[1];
            } elseif ($filtros['rango_precio'] == '20-50') {
                 $sql .= " AND precio >= :min AND precio <= :max";
                 $params[':min'] = 20;
                 $params[':max'] = 50;
            }
        }

        // --- Ordenamiento ---
        if (!empty($filtros['orden'])) {
            if ($filtros['orden'] == 'barato') {
                $sql .= " ORDER BY precio ASC";
            } elseif ($filtros['orden'] == 'caro') {
                $sql .= " ORDER BY precio DESC";
            }
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>