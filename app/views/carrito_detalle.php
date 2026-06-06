<?php
// carrito_detalle.php
?>

<div class="container my-5">
    <div class="titulo_pagina">
        <h1 class="h3">Tu carrito de dulces</h1>
    </div>

    <?php if (!empty($productos_carrito)): ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="tabla_movil shadow-sm rounded bg-white p-4 border">
                    <table class="table align-middle mb-0">
                        <thead class="text-muted small text-uppercase">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio</th>
                                <th class="text-end">Total</th>
                                <th class="text-end">Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_carrito = 0;
                            foreach ($productos_carrito as $item):
                                $cantidad = $_SESSION['carrito'][$item['id_producto']];
                                $subtotal = $item['precio'] * $cantidad;
                                $total_carrito += $subtotal;
                                $imagenProducto = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $item['imagen']);
                            ?>
                                <tr>
                                    <td data-label="Producto">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="assets/imagenes/<?php echo htmlspecialchars($imagenProducto); ?>"
                                                 alt="<?php echo htmlspecialchars($item['nombre']); ?>"
                                                 style="width: 54px; height: 54px; object-fit: contain;">
                                            <div>
                                                <span class="fw-bold d-block"><?php echo htmlspecialchars($item['nombre']); ?></span>
                                                <span class="text-muted small"><?php echo htmlspecialchars($item['categoria']); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Cantidad" class="text-center">
                                        <span class="badge bg-red rounded-pill px-3 py-2"><?php echo $cantidad; ?></span>
                                    </td>
                                    <td data-label="Precio" class="text-end text-muted"><?php echo number_format($item['precio'], 2); ?>&euro;</td>
                                    <td data-label="Total" class="text-end fw-bold"><?php echo number_format($subtotal, 2); ?>&euro;</td>
                                    <td data-label="Quitar" class="text-end">
                                        <a href="index.php?controlador=ControladorCarrito&accion=eliminar&id=<?php echo $item['id_producto']; ?>" class="text-red" aria-label="Eliminar <?php echo htmlspecialchars($item['nombre']); ?> del carrito">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-between carrito_botones">
                    <a href="index.php?controlador=ControladorProducto&accion=listar" class="btn btn-secundario rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Seguir comprando
                    </a>
                    <a href="index.php?controlador=ControladorCarrito&accion=vaciar" class="btn btn-secundario rounded-pill px-4">
                        Vaciar carrito
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm overflow-hidden resumen_pedido">
                    <div class="card-header bg-red text-white py-3">
                        <h2 class="h5 mb-0 fw-bold">Resumen del pedido</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span><?php echo number_format($total_carrito, 2); ?>&euro;</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Envio</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 fw-bold">TOTAL</span>
                            <span class="h5 fw-bold text-red"><?php echo number_format($total_carrito, 2); ?>&euro;</span>
                        </div>

                        <?php if (isset($_SESSION['usuario_logueado'])): ?>
                            <a href="index.php?controlador=ControladorPedido&accion=confirmar" class="btn btn-rojo w-100 py-3 rounded-pill shadow-sm">
                                Finalizar compra <i class="bi bi-check-circle-fill ms-2"></i>
                            </a>
                        <?php else: ?>
                            <div class="alert alert-warning small border-0 mb-0">
                                Debes <a href="index.php?controlador=ControladorAutenticacion&accion=mostrarLogin" class="fw-bold text-dark text-decoration-none">iniciar sesion</a> para finalizar el pedido.
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
            <h2 class="fw-bold">Tu carrito esta vacio</h2>
            <p class="text-muted">Todavia no has anadido ningun producto.</p>
            <a href="index.php?controlador=ControladorProducto&accion=listar" class="btn btn-rojo rounded-pill px-5 py-2 mt-3">Ir a la carta</a>
        </div>
    <?php endif; ?>
</div>