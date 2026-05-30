<?php
$ultimoPedido = !empty($pedidos) ? $pedidos[0] : null;
?>

<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <h2 class="h3 fw-bold mb-0 text-uppercase">Mi cuenta</h2>
        <div class="flex-grow-1 ms-3 border-bottom border-2" style="border-color: #E84988 !important;"></div>
    </div>

    <?php if (isset($_SESSION['success_perfil'])): ?>
        <div class="alert alert-success">
            <?php
                echo htmlspecialchars($_SESSION['success_perfil']);
                unset($_SESSION['success_perfil']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_perfil'])): ?>
        <div class="alert alert-danger">
            <?php
                echo htmlspecialchars($_SESSION['error_perfil']);
                unset($_SESSION['error_perfil']);
            ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-pink text-white py-3">
                    <h5 class="mb-0 fw-bold">Datos personales</h5>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?controlador=ControladorUsuario&accion=actualizar" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                   value="<?php echo htmlspecialchars($cliente['nombre'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?php echo htmlspecialchars($cliente['email'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Nueva contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Déjala vacía para no cambiarla">
                        </div>

                        <button type="submit" class="btn btn-nintendo-pink w-100 rounded-pill py-2">
                            Guardar cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <?php if ($ultimoPedido): ?>
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="mb-0 fw-bold">Último pedido</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
                            <span><strong>Pedido:</strong> #<?php echo $ultimoPedido['id_pedido']; ?></span>
                            <span><strong>Fecha:</strong> <?php echo htmlspecialchars($ultimoPedido['fecha']); ?></span>
                            <span><strong>Estado:</strong> <?php echo htmlspecialchars($ultimoPedido['estado']); ?></span>
                            <span class="fw-bold text-pink"><?php echo number_format($ultimoPedido['total'], 2); ?>€</span>
                        </div>

                        <?php if (!empty($detallesPedidos[$ultimoPedido['id_pedido']])): ?>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-end">Precio</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detallesPedidos[$ultimoPedido['id_pedido']] as $detalle): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="assets/imagenes/<?php echo htmlspecialchars($detalle['imagen']); ?>"
                                                             alt="<?php echo htmlspecialchars($detalle['nombre']); ?>"
                                                             style="width: 45px; height: 45px; object-fit: contain;">
                                                        <span class="fw-bold"><?php echo htmlspecialchars($detalle['nombre']); ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-center"><?php echo $detalle['cantidad']; ?></td>
                                                <td class="text-end"><?php echo number_format($detalle['precio_unitario'], 2); ?>€</td>
                                                <td class="text-end fw-bold"><?php echo number_format($detalle['subtotal'], 2); ?>€</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-pink text-white py-3">
                    <h5 class="mb-0 fw-bold">Historial de pedidos</h5>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($pedidos)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pedidos as $pedido): ?>
                                        <tr>
                                            <td>#<?php echo $pedido['id_pedido']; ?></td>
                                            <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                                            <td><?php echo htmlspecialchars($pedido['estado']); ?></td>
                                            <td class="text-end fw-bold"><?php echo number_format($pedido['total'], 2); ?>€</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">Todavía no has realizado ningún pedido.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>