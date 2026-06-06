<?php
// producto_detalle.php
$imagenProducto = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $producto['imagen']);
?>

<div class="container py-5">
    <div class="titulo_pagina">
        <h1 class="h3">Detalle del producto</h1>
    </div>

    <div class="row g-4 align-items-center">
        <div class="col-lg-5">
            <div class="bg-light border rounded p-4 text-center">
                <img src="assets/imagenes/<?php echo htmlspecialchars($imagenProducto); ?>"
                     alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                     style="max-height: 360px; object-fit: contain;">
            </div>
        </div>

        <div class="col-lg-7">
            <span class="badge bg-red mb-3"><?php echo htmlspecialchars($producto['categoria']); ?></span>
            <h2 class="fw-bold mb-3"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
            <p class="text-muted fs-5"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p class="price-tag"><?php echo number_format($producto['precio'], 2); ?>&euro;</p>

            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                <?php if ((int) ($producto['stock'] ?? 0) > 0): ?>
                    <a href="index.php?controlador=ControladorCarrito&accion=anadir&id=<?php echo $producto['id_producto']; ?>" class="btn btn-rojo rounded-pill px-4 py-2">
                        Anadir al carrito
                    </a>
                <?php else: ?>
                    <span class="btn btn-agotado rounded-pill px-4 py-2">Agotado</span>
                <?php endif; ?>
                <a href="index.php?controlador=ControladorProducto&accion=listar" class="btn btn-secundario rounded-pill px-4 py-2">
                    Volver a la carta
                </a>
            </div>
        </div>
    </div>
</div>