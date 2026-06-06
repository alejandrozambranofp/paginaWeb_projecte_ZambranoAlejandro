<div class="home_ancho py-5">
    <a href="index.php" class="btn btn-secundario boton_volver mb-4">Volver</a>
    <div class="titulo_home mb-4">
        <h1>Mas comprado</h1>
    </div>

    <p class="text-muted mb-4">Productos ordenados por las unidades vendidas en los pedidos.</p>

    <div class="product-scroll d-flex flex-nowrap overflow-auto pb-4 gap-4">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $item): ?>
                <?php $imagen = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $item['imagen'] ?? ''); ?>
                <article class="producto_home flex-shrink-0">
                    <a href="index.php?controlador=ControladorProducto&accion=ver&id=<?php echo $item['id_producto']; ?>" class="producto_home_imagen">
                        <img src="assets/imagenes/<?php echo htmlspecialchars($imagen); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                        <span><?php echo (int) $item['total_vendido']; ?> vendidos</span>
                    </a>
                    <div class="producto_home_info">
                        <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                        <p><?php echo htmlspecialchars($item['descripcion']); ?></p>
                        <strong><?php echo number_format($item['precio'], 2); ?>&euro;</strong>
                    </div>
                    <?php if ((int) ($item['stock'] ?? 0) > 0): ?>
                        <a class="btn btn-nintendo-red w-100 boton_anadir_home" href="index.php?controlador=ControladorCarrito&accion=anadir&id=<?php echo $item['id_producto']; ?>">Anadir</a>
                    <?php else: ?>
                        <span class="btn btn-agotado w-100">Agotado</span>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Todavia no hay productos vendidos.</p>
        <?php endif; ?>
    </div>
</div>