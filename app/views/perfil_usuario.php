<?php
$ultimoPedido = !empty($pedidos) ? $pedidos[0] : null;
?>

<div class="container py-5">
    <div class="titulo_pagina">
        <h1 class="h3">Mi cuenta</h1>
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
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-red text-white py-3">
                    <h2 class="h5 mb-0 fw-bold">Datos personales</h2>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <a href="index.php?controlador=ControladorAutenticacion&accion=logout" class="btn btn-secundario w-100 rounded-pill">
                            Cerrar sesion
                        </a>
                    </div>

                    <form action="index.php?controlador=ControladorUsuario&accion=actualizar" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Nueva contrasena</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Dejala vacia para no cambiarla">
                        </div>

                        <button type="submit" class="btn btn-rojo w-100 rounded-pill py-2">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <?php if ($ultimoPedido): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-dark text-white py-3">
                        <h2 class="h5 mb-0 fw-bold">Ultimo pedido</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
                            <span><strong>Pedido:</strong> #<?php echo $ultimoPedido['id_pedido']; ?></span>
                            <span><strong>Fecha:</strong> <?php echo htmlspecialchars($ultimoPedido['fecha']); ?></span>
                            <span><strong>Estado:</strong> <?php echo htmlspecialchars($ultimoPedido['estado']); ?></span>
                            <span class="fw-bold text-red"><?php echo number_format($ultimoPedido['total'], 2); ?>&euro;</span>
                        </div>

                        <?php if (!empty($detallesPedidos[$ultimoPedido['id_pedido']])): ?>
                            <div class="tabla_movil">
                                <table class="table align-middle mb-0">
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
                                                <td data-label="Producto">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="assets/imagenes/<?php echo htmlspecialchars(preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $detalle['imagen'])); ?>" alt="<?php echo htmlspecialchars($detalle['nombre']); ?>" style="width: 45px; height: 45px; object-fit: contain;">
                                                        <span class="fw-bold"><?php echo htmlspecialchars($detalle['nombre']); ?></span>
                                                    </div>
                                                </td>
                                                <td data-label="Cantidad" class="text-center"><?php echo $detalle['cantidad']; ?></td>
                                                <td data-label="Precio" class="text-end"><?php echo number_format($detalle['precio_unitario'], 2); ?>&euro;</td>
                                                <td data-label="Subtotal" class="text-end fw-bold"><?php echo number_format($detalle['subtotal'], 2); ?>&euro;</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-red text-white py-3">
                    <h2 class="h5 mb-0 fw-bold">Historial de pedidos</h2>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($pedidos)): ?>
                        <div class="tabla_movil">
                            <table class="table align-middle mb-0">
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
                                            <td data-label="Pedido">#<?php echo $pedido['id_pedido']; ?></td>
                                            <td data-label="Fecha"><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                                            <td data-label="Estado"><?php echo htmlspecialchars($pedido['estado']); ?></td>
                                            <td data-label="Total" class="text-end fw-bold"><?php echo number_format($pedido['total'], 2); ?>&euro;</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">Todavia no has realizado ningun pedido.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
