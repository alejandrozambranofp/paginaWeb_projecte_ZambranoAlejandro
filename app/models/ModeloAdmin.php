<?php
// Consultas del panel de administracion.
class ModeloAdmin {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    public function obtenerPedidos($filtros = []) {
        $sql = "SELECT p.id_pedido, p.fecha, p.total, p.estado,
                       c.id_cliente, c.nombre, c.email
                FROM pedido p
                INNER JOIN cliente c ON p.id_cliente = c.id_cliente
                WHERE 1=1";

        $params = [];

        if (!empty($filtros['usuario'])) {
            $sql .= " AND (c.nombre LIKE :usuario OR c.email LIKE :usuario)";
            $params[':usuario'] = "%" . $filtros['usuario'] . "%";
        }

        if (!empty($filtros['fecha'])) {
            $sql .= " AND DATE(p.fecha) = :fecha";
            $params[':fecha'] = $filtros['fecha'];
        }

        $ordenesPermitidos = [
            'fecha_desc' => 'p.fecha DESC',
            'fecha_asc' => 'p.fecha ASC',
            'precio_desc' => 'p.total DESC',
            'precio_asc' => 'p.total ASC'
        ];

        $orden = $filtros['orden'] ?? 'fecha_desc';
        $sql .= " ORDER BY " . ($ordenesPermitidos[$orden] ?? $ordenesPermitidos['fecha_desc']);

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductos() {
        $stmt = $this->db->prepare("SELECT * FROM producto ORDER BY id_producto DESC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerLogs() {
        $stmt = $this->db->prepare("SELECT * FROM logs ORDER BY fecha DESC LIMIT 50");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearProducto($datos) {
        $sql = "INSERT INTO producto (nombre, descripcion, precio, imagen, categoria, stock, oferta, franquicia)
                VALUES (:nombre, :descripcion, :precio, :imagen, :categoria, :stock, :oferta, :franquicia)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':descripcion' => $datos['descripcion'],
            ':precio' => $datos['precio'],
            ':imagen' => $datos['imagen'],
            ':categoria' => $datos['categoria'],
            ':stock' => $datos['stock'],
            ':oferta' => $datos['oferta'],
            ':franquicia' => $datos['franquicia']
        ]);
    }

    public function actualizarProducto($datos) {
        $sql = "UPDATE producto
                SET nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    imagen = :imagen,
                    categoria = :categoria,
                    stock = :stock,
                    oferta = :oferta,
                    franquicia = :franquicia
                WHERE id_producto = :id_producto";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_producto' => $datos['id_producto'],
            ':nombre' => $datos['nombre'],
            ':descripcion' => $datos['descripcion'],
            ':precio' => $datos['precio'],
            ':imagen' => $datos['imagen'],
            ':categoria' => $datos['categoria'],
            ':stock' => $datos['stock'],
            ':oferta' => $datos['oferta'],
            ':franquicia' => $datos['franquicia']
        ]);
    }

    public function productoTienePedidos($id_producto) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM detalle_pedido WHERE id_producto = ?");
        $stmt->execute([$id_producto]);

        return $stmt->fetchColumn() > 0;
    }

    public function eliminarProducto($id_producto) {
        if ($this->productoTienePedidos($id_producto)) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM producto WHERE id_producto = ?");
        return $stmt->execute([$id_producto]);
    }

    public function actualizarEstadoPedido($id_pedido, $estado) {
        $stmt = $this->db->prepare("UPDATE pedido SET estado = ? WHERE id_pedido = ?");
        return $stmt->execute([$estado, $id_pedido]);
    }

    public function registrarLog($usuario, $accion) {
        $stmt = $this->db->prepare("INSERT INTO logs (usuario, accion) VALUES (?, ?)");
        return $stmt->execute([$usuario, $accion]);
    }
}
?>