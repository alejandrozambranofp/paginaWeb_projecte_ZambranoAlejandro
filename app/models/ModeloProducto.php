<?php
// Modelo con las consultas de productos.
class ModeloProducto {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    public function obtenerTodos() {
        $stmt = $this->db->prepare("SELECT * FROM producto ORDER BY id_producto ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id_producto) {
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $stmt->execute([$id_producto]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerPorCategoria($categoria) {
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE categoria = ? ORDER BY id_producto ASC");
        $stmt->execute([$categoria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProductos($termino) {
        $sql = "SELECT * FROM producto WHERE nombre LIKE :termino OR descripcion LIKE :termino ORDER BY id_producto ASC";
        $stmt = $this->db->prepare($sql);
        $t = "%" . $termino . "%";
        $stmt->bindParam(':termino', $t);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorFranquicia($franquicia) {
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE franquicia = ? ORDER BY id_producto ASC");
        $stmt->execute([$franquicia]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEspeciales() {
        // Productos que se muestran en la pagina de especiales.
        $ids = [8, 2, 6];
        $marcas = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("SELECT * FROM producto WHERE id_producto IN ($marcas) ORDER BY FIELD(id_producto, 8, 2, 6)");
        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerNovedades() {
        $stmt = $this->db->prepare("SELECT * FROM producto ORDER BY id_producto DESC LIMIT 4");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMasComprados() {
        // Sumo las cantidades de detalle_pedido para saber que productos se han vendido mas.
        $sql = "SELECT p.*, SUM(dp.cantidad) AS total_vendido
                FROM producto p
                INNER JOIN detalle_pedido dp ON p.id_producto = dp.id_producto
                GROUP BY p.id_producto
                ORDER BY total_vendido DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductosFiltrados($filtros) {
        // La consulta se va completando segun los filtros recibidos.
        $sql = "SELECT * FROM producto WHERE 1=1";
        $params = [];

        if (!empty($filtros['franquicia'])) {
            $sql .= " AND (franquicia LIKE :franquicia OR nombre LIKE :franquicia OR descripcion LIKE :franquicia)";
            $params[':franquicia'] = "%" . $filtros['franquicia'] . "%";
        }

        if (!empty($filtros['tipo'])) {
            $sql .= " AND categoria = :categoria";
            $params[':categoria'] = $filtros['tipo'];
        }

        if (!empty($filtros['ofertas'])) {
            $sql .= " AND (oferta = 1 OR categoria = 'Ofertas')";
        }

        if (!empty($filtros['agotados'])) {
            $sql .= " AND stock > 0";
        }

        if (!empty($filtros['rango_precio'])) {
            if ($filtros['rango_precio'] === '20-999') {
                $sql .= " AND precio >= :min";
                $params[':min'] = 20;
            } else {
                $rango = explode('-', $filtros['rango_precio']);
                if (count($rango) === 2) {
                    $sql .= " AND precio >= :min AND precio <= :max";
                    $params[':min'] = $rango[0];
                    $params[':max'] = $rango[1];
                }
            }
        }

        if (!empty($filtros['orden'])) {
            if ($filtros['orden'] === 'nuevo') {
                $sql .= " ORDER BY id_producto DESC";
            } elseif ($filtros['orden'] === 'barato') {
                $sql .= " ORDER BY precio ASC";
            } elseif ($filtros['orden'] === 'caro') {
                $sql .= " ORDER BY precio DESC";
            } else {
                $sql .= " ORDER BY id_producto ASC";
            }
        } else {
            $sql .= " ORDER BY id_producto ASC";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
