<?php
//ModeloCliente.php
class ModeloCliente {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    /**
     * Busca un cliente por su email
     * Este método es vital para el proceso de Login.
     * Recupera el hash de la contraseña para que el controlador pueda usar password_verify().
     */
    public function obtenerClientePorEmail($email) {
        try {
            // Seleccionamos los campos necesarios para la sesión y la verificación de password
            $sql = "SELECT id_cliente, nombre, email, password FROM cliente WHERE email = :email";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Debug opcional: Si el resultado existe pero el login falla, 
            // es porque la contraseña en la DB no es un hash de password_hash().
            return $resultado ? $resultado : null;

        } catch(PDOException $e) {
            error_log("Error al buscar cliente: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Registra un nuevo cliente
     * El controlador debe pasar el password ya hasheado con password_hash().
     */
    public function registrarCliente($nombre, $email, $password_hash) {
        try {
            // Insertamos los datos básicos. id_cliente es AUTO_INCREMENT en la base de datos.
            $sql = "INSERT INTO cliente (nombre, email, password) 
                    VALUES (:nombre, :email, :password)";
            
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_hash, PDO::PARAM_STR);
            
            return $stmt->execute();

        } catch(PDOException $e) {
            // Registro del error real en el log del servidor para depuración
            error_log("FALLO CRÍTICO EN REGISTRO: " . $e->getMessage());
            return false;
        }
    }

        public function obtenerClientePorId($id_cliente) {
        try {
            $sql = "SELECT id_cliente, nombre, email FROM cliente WHERE id_cliente = :id_cliente";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener cliente: " . $e->getMessage());
            return null;
        }
    }

    public function actualizarCliente($id_cliente, $nombre, $email, $password = null) {
        try {
            if (!empty($password)) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "UPDATE cliente 
                        SET nombre = :nombre, email = :email, password = :password 
                        WHERE id_cliente = :id_cliente";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':password', $password_hash, PDO::PARAM_STR);
            } else {
                $sql = "UPDATE cliente 
                        SET nombre = :nombre, email = :email 
                        WHERE id_cliente = :id_cliente";

                $stmt = $this->db->prepare($sql);
            }

            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar cliente: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPedidosCliente($id_cliente) {
        try {
            $sql = "SELECT id_pedido, fecha, total, estado 
                    FROM pedido 
                    WHERE id_cliente = :id_cliente 
                    ORDER BY fecha DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener pedidos del cliente: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerDetallePedido($id_pedido, $id_cliente) {
        try {
            $sql = "SELECT dp.id_detalle, dp.id_pedido, dp.id_producto, dp.cantidad,
                           dp.precio_unitario, dp.subtotal, p.nombre, p.imagen
                    FROM detalle_pedido dp
                    INNER JOIN pedido pe ON dp.id_pedido = pe.id_pedido
                    INNER JOIN producto p ON dp.id_producto = p.id_producto
                    WHERE dp.id_pedido = :id_pedido
                    AND pe.id_cliente = :id_cliente";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener detalle del pedido: " . $e->getMessage());
            return [];
        }
    }
}