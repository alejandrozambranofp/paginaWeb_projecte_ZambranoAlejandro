<div class="home_ancho py-5">
    <a href="index.php" class="btn btn-secundario boton_volver mb-4">Volver</a>
    <div class="titulo_home mb-4">
        <h1>Franquicias</h1>
    </div>

    <?php if (!empty($franquicias)): ?>
        <?php foreach ($franquicias as $nombreFranquicia => $productosFranquicia): ?>
            <section class="mb-5">
                <div class="titulo_home mb-4">
                    <h2><?php echo htmlspecialchars($nombreFranquicia); ?></h2>
                </div>

                <div class="product-scroll d-flex flex-nowrap overflow-auto pb-4 gap-4">
                    <?php foreach ($productosFranquicia as $item): ?>
                        <?php $imagen = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $item['imagen'] ?? ''); ?>
                        <article class="producto_home flex-shrink-0">
                            <a href="index.php?controlador=ControladorProducto&accion=ver&id=<?php echo $item['id_producto']; ?>" class="producto_home_imagen">
                                <img src="assets/imagenes/<?php echo htmlspecialchars($imagen); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                                <span><?php echo htmlspecialchars($item['categoria']); ?></span>
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
                </div>
            </section>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No hay productos por franquicia.</p>
    <?php endif; ?>
</div>