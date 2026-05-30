<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <h2 class="h3 fw-bold mb-0 text-uppercase">Panel de administración</h2>
        <div class="flex-grow-1 ms-3 border-bottom border-2" style="border-color: #E84988 !important;"></div>
    </div>

    <ul class="nav nav-tabs mb-4" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="pedidos-tab" data-bs-toggle="tab" data-bs-target="#pedidos" type="button" role="tab">
                Pedidos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="productos-tab" data-bs-toggle="tab" data-bs-target="#productos" type="button" role="tab">
                Productos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button" role="tab">
                Logs
            </button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabsContent">
        <div class="tab-pane fade show active" id="pedidos" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold">Filtrar y ordenar pedidos</h5>
                </div>
                <div class="card-body p-4">
                    <form action="index.php" method="GET" class="row g-3">
                        <input type="hidden" name="controlador" value="ControladorAdmin">
                        <input type="hidden" name="accion" value="panel">

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Usuario</label>
                            <input type="text" name="usuario" class="form-control"
                                   value="<?php echo htmlspecialchars($_GET['usuario'] ?? ''); ?>"
                                   placeholder="Nombre o email">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Fecha</label>
                            <input type="date" name="fecha" class="form-control"
                                   value="<?php echo htmlspecialchars($_GET['fecha'] ?? ''); ?>">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Orden</label>
                            <select name="orden" class="form-select">
                                <?php $ordenActual = $_GET['orden'] ?? 'fecha_desc'; ?>
                                <option value="fecha_desc" <?php echo $ordenActual === 'fecha_desc' ? 'selected' : ''; ?>>Fecha reciente</option>
                                <option value="fecha_asc" <?php echo $ordenActual === 'fecha_asc' ? 'selected' : ''; ?>>Fecha antigua</option>
                                <option value="precio_desc" <?php echo $ordenActual === 'precio_desc' ? 'selected' : ''; ?>>Precio mayor</option>
                                <option value="precio_asc" <?php echo $ordenActual === 'precio_asc' ? 'selected' : ''; ?>>Precio menor</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-nintendo-pink w-100" type="submit">Aplicar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-pink text-white py-3">
                    <h5 class="mb-0 fw-bold">Todos los pedidos</h5>
                </div>
                <div class="card-body p-4">`
                    <div class="d-flex justify-content-end align-items-center gap-2 mb-3">
                        <label for="currencySelect" class="fw-bold small mb-0">Moneda</label>
                        <select id="currencySelect" class="form-select form-select-sm" style="max-width: 140px;">
                            <option value="EUR" data-rate="1" selected>EUR</option>
                            <option value="USD" data-rate="1.08">USD</option>
                            <option value="GBP" data-rate="0.86">GBP</option>
                            <option value="JPY" data-rate="170">JPY</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th class="text-end">Guardar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $pedido): ?>
                                    <tr>
                                        <td>#<?php echo $pedido['id_pedido']; ?></td>
                                        <td><?php echo htmlspecialchars($pedido['nombre']); ?></td>
                                        <td><?php echo htmlspecialchars($pedido['email']); ?></td>
                                        <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                                        <td class="fw-bold admin-money" data-eur="<?php echo $pedido['total']; ?>">
                                            <?php echo number_format($pedido['total'], 2); ?>€
                                        </td>
                                        <td>
                                            <form action="index.php?controlador=ControladorAdmin&accion=actualizarPedido" method="POST" class="d-flex gap-2">
                                                <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_pedido']; ?>">
                                                <select name="estado" class="form-select form-select-sm">
                                                    <?php
                                                        $estados = ['Confirmado', 'Preparando', 'Enviado', 'Entregado', 'Cancelado'];
                                                        foreach ($estados as $estado):
                                                    ?>
                                                        <option value="<?php echo $estado; ?>" <?php echo $pedido['estado'] === $estado ? 'selected' : ''; ?>>
                                                            <?php echo $estado; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                        </td>
                                        <td class="text-end">
                                                <button type="submit" class="btn btn-sm btn-outline-dark">Guardar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php if (empty($pedidos)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">No hay pedidos con esos filtros.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="productos" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold">Crear producto</h5>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?controlador=ControladorAdmin&accion=crearProducto" method="POST" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold">Precio</label>
                            <input type="number" name="precio" class="form-control" step="0.01" min="0" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold">Stock</label>
                            <input type="number" name="stock" class="form-control" min="0" value="10">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold">Categoría</label>
                            <input type="text" name="categoria" class="form-control" value="Postres">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold">Franquicia</label>
                            <input type="text" name="franquicia" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Imagen</label>
                            <input type="text" name="imagen" class="form-control" value="logo_header.png">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Descripción</label>
                            <input type="text" name="descripcion" class="form-control">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="oferta" id="ofertaAdmin">
                                <label class="form-check-label" for="ofertaAdmin">Oferta</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-nintendo-pink rounded-pill px-4">Crear producto</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-pink text-white py-3">
                    <h5 class="mb-0 fw-bold">Productos</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Oferta</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td><?php echo $producto['id_producto']; ?></td>
                                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                                        <td><?php echo number_format($producto['precio'], 2); ?>€</td>
                                        <td><?php echo $producto['stock'] ?? 0; ?></td>
                                        <td><?php echo !empty($producto['oferta']) ? 'Sí' : 'No'; ?></td>
                                        <td class="text-end">
                                            <a href="index.php?controlador=ControladorAdmin&accion=eliminarProducto&id=<?php echo $producto['id_producto']; ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('¿Eliminar este producto?');">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php if (empty($productos)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">No hay productos.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="logs" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold">Historial de logs</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Acción</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logs as $log): ?>
                                    <tr>
                                        <td><?php echo $log['id_log']; ?></td>
                                        <td><?php echo htmlspecialchars($log['usuario']); ?></td>
                                        <td><?php echo htmlspecialchars($log['accion']); ?></td>
                                        <td><?php echo htmlspecialchars($log['fecha']); ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php if (empty($logs)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Todavía no hay logs.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/admin_panel.js"></script>