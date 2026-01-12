<?php
//carrito.detalle.php
?>

<div class="container my-5">
    <div class="d-flex align-items-center mb-4">
        <h2 class="h3 fw-bold mb-0 text-uppercase" style="letter-spacing: 1px;">Tu Carrito de Dulces</h2>
        <div class="flex-grow-1 ms-3 border-bottom border-2" style="border-color: #E84988 !important;"></div>
    </div>

    <?php if (!empty($productos_carrito)): ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive shadow-sm rounded-4 bg-white p-4">
                    <table class="table align-middle">
                        <thead class="text-muted small text-uppercase">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unid.</th>
                                <th class="text-end">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_carrito = 0;
                            foreach ($productos_carrito as $item): 
                                $cantidad = $_SESSION['carrito'][$item['id_producto']];
                                $subtotal = $item['precio'] * $cantidad;
                                $total_carrito += $subtotal;
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-3 p-1 me-3">
                                            <img src="assets/imagenes/<?php echo $item['imagen']; ?>" 
                                                 alt="<?php echo htmlspecialchars($item['nombre']); ?>" 
                                                 style="width: 50px; height: 50px; object-fit: contain;"
                                                 onerror="this.src='https://placehold.co/100x100?text=Dulce';">
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block"><?php echo htmlspecialchars($item['nombre']); ?></span>
                                            <span class="text-muted small"><?php echo htmlspecialchars($item['categoria']); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="badge bg-light text-dark border p-2 px-3 rounded-pill">
                                            <?php echo $cantidad; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="text-end text-muted"><?php echo number_format($item['precio'], 2); ?>€</td>
                                <td class="text-end fw-bold"><?php echo number_format($subtotal, 2); ?>€</td>
                                <td class="text-end">
                                    <a href="index.php?controlador=ControladorCarrito&accion=eliminar&id=<?php echo $item['id_producto']; ?>" class="text-danger">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 d-flex justify-content-between">
                    <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Seguir comprando
                    </a>
                    <a href="index.php?controlador=ControladorCarrito&accion=vaciar" class="btn btn-link text-muted text-decoration-none small">
                        Vaciar carrito
                    </a>
                </div>
            </div>

            <!-- Resumen del pedido -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-pink text-white py-3">
                        <h5 class="mb-0 fw-bold">Resumen del Pedido</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span><?php echo number_format($total_carrito, 2); ?>€</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Envío</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 fw-bold">TOTAL</span>
                            <span class="h5 fw-bold text-pink"><?php echo number_format($total_carrito, 2); ?>€</span>
                        </div>
                        
                        <?php if (isset($_SESSION['usuario_logueado'])): ?>
                            <a href="index.php?controlador=ControladorPedido&accion=confirmar" class="btn btn-nintendo-pink w-100 py-3 rounded-pill shadow-sm">
                                FINALIZAR COMPRA <i class="bi bi-check-circle-fill ms-2"></i>
                            </a>
                        <?php else: ?>
                            <div class="alert alert-warning small border-0 mb-0">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Debes <a href="index.php?controlador=ControladorAutenticacion&accion=mostrarLogin" class="fw-bold text-dark text-decoration-none">iniciar sesión</a> para finalizar el pedido.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="bg-light d-inline-block rounded-circle p-4 mb-4">
                <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
            </div>
            <h3 class="fw-bold">Tu carrito está vacío</h3>
            <p class="text-muted">Parece que aún no has añadido ninguna delicia de nuestro reino.</p>
            <a href="index.php" class="btn btn-nintendo-pink rounded-pill px-5 py-2 mt-3">IR A LA CARTA</a>
        </div>
    <?php endif; ?>
</div>