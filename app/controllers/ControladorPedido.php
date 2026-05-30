<?php
/**
 * ControladorPedido.php
 * Gestiona la finalización de la compra y el registro en la base de datos.
 */

class ControladorPedido {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function confirmar() {
        if (!isset($_SESSION['usuario_logueado'])) {
            header("Location: index.php?controlador=ControladorAutenticacion&accion=mostrarLogin");
            exit();
        }

        if (empty($_SESSION['carrito'])) {
            header("Location: index.php");
            exit();
        }

        try {
            $this->db->beginTransaction();

            $id_cliente = $_SESSION['usuario_logueado']['id_cliente'];
            $total = 0;
            $productosPedido = [];

            foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
                $stmt = $this->db->prepare("SELECT id_producto, nombre, precio FROM producto WHERE id_producto = ?");
                $stmt->execute([$id_producto]);
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($producto) {
                    $subtotal = $producto['precio'] * $cantidad;
                    $total += $subtotal;

                    $productosPedido[] = [
                        'id_producto' => $producto['id_producto'],
                        'cantidad' => $cantidad,
                        'precio_unitario' => $producto['precio'],
                        'subtotal' => $subtotal
                    ];
                }
            }

            if (empty($productosPedido)) {
                throw new Exception("No se encontraron productos válidos en el carrito.");
            }

            $stmtPedido = $this->db->prepare(
                "INSERT INTO pedido (id_cliente, total, estado) VALUES (?, ?, ?)"
            );
            $stmtPedido->execute([$id_cliente, $total, 'Confirmado']);

            $id_pedido = $this->db->lastInsertId();

            $stmtDetalle = $this->db->prepare(
                "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal)
                 VALUES (?, ?, ?, ?, ?)"
            );

            foreach ($productosPedido as $item) {
                $stmtDetalle->execute([
                    $id_pedido,
                    $item['id_producto'],
                    $item['cantidad'],
                    $item['precio_unitario'],
                    $item['subtotal']
                ]);
            }

            $stmtLog = $this->db->prepare(
                "INSERT INTO logs (usuario, accion) VALUES (?, ?)"
            );
            $stmtLog->execute([
                $_SESSION['usuario_logueado']['email'],
                "Pedido confirmado con ID " . $id_pedido
            ]);

            $this->db->commit();

            $_SESSION['carrito'] = [];
            $_SESSION['mensaje_exito_compra'] = "¡Gracias por tu compra! Tu pedido #" . $id_pedido . " ha sido procesado con éxito.";

            $view = 'compra_exitosa.php';
            require_once 'app/views/inicio.php';

        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            die("Error al procesar el pedido: " . $e->getMessage());
        }
    }
}
?>