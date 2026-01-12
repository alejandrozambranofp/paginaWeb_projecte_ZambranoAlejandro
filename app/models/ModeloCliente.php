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
}