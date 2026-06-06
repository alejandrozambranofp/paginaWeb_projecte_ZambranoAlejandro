<?php
$productosHome = $productos ?? [];
?>

<section id="carouselSweetKingdom" class="carousel slide home_banner mb-0" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Banner Mario Kart"></button>
        <button type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide-to="1" aria-label="Banner Zelda"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <div class="banner_marco">
                <img src="assets/imagenes/banner_mario_kart.webp" class="banner_img" alt="Pack Mario Kart World exclusivo">
            </div>
            <div class="banner_accion">
                <h2>Pack especial: Mario Kart</h2>
                <a href="index.php?controlador=ControladorProducto&accion=ver&id=9" class="btn btn-nintendo-red">Ya disponible</a>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
            <div class="banner_marco">
                <img src="assets/imagenes/tarta_zelda_banner.webp" class="banner_img" alt="Postres Zelda Tears of the Kingdom">
            </div>
            <div class="banner_accion">
                <h2>Postres: The Legend of Zelda Tears of the Kingdom</h2>
                <a href="index.php?controlador=ControladorProducto&accion=ver&id=8" class="btn btn-nintendo-red">Ya disponible</a>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide="prev" aria-label="Banner anterior">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide="next" aria-label="Banner siguiente">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</section>

<section class="home_bloque_gris">
    <div class="home_ancho py-4">
        <div class="home_botones mb-4">
            <div class="row g-0 justify-content-center">
                <div class="col-6 col-md-3">
                    <a href="index.php?controlador=ControladorProducto&accion=franquicias" class="acceso_home">
                        <img src="assets/imagenes/franquicias.svg" alt="Franquicias">
                        <span>Franquicias</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="index.php?controlador=ControladorProducto&accion=listar" class="acceso_home">
                        <img src="assets/imagenes/menu.svg" alt="Menu">
                        <span>Menu</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="index.php?controlador=ControladorProducto&accion=especiales" class="acceso_home">
                        <img src="assets/imagenes/especiales.svg" alt="Especiales">
                        <span>Especiales</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="index.php?controlador=ControladorProducto&accion=masComprado" class="acceso_home">
                        <img src="assets/imagenes/mascomprado.svg" alt="Mas comprado">
                        <span>Mas comprado</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-lg-4">
                <article class="tarjeta_home">
                    <div>
                        <h2>Pack especial: Mario Kart</h2>
                        <p>Estan disponibles varios packs de Mario Kart World que incluyen postres y detalles exclusivos.</p>
                        <a href="index.php?controlador=ControladorProducto&accion=ver&id=9">Echales un ojo</a>
                    </div>
                    <img src="assets/imagenes/mariopower3.webp" alt="Mario Kart World">
                </article>
            </div>
            <div class="col-12 col-lg-4">
                <article class="tarjeta_home">
                    <div>
                        <h2>Animal Crossing</h2>
                        <p>Estan disponibles varios packs de Animal Crossing que incluyen postres y detalles exclusivos.</p>
                        <a href="index.php?controlador=ControladorProducto&accion=ver&id=10">Echales un ojo</a>
                    </div>
                    <img src="assets/imagenes/ac3.webp" alt="Animal Crossing">
                </article>
            </div>
            <div class="col-12 col-lg-4">
                <article class="tarjeta_home">
                    <div>
                        <h2>The Legend of Zelda: Link's Awakening</h2>
                        <p>Estan disponibles varios packs de The Legend of Zelda: Link's Awakening que incluyen postres.</p>
                        <a href="index.php?controlador=ControladorProducto&accion=ver&id=11">Echales un ojo</a>
                    </div>
                    <img src="assets/imagenes/linksweet3.webp" alt="The Legend of Zelda Link's Awakening">
                </article>
            </div>
        </div>
    </div>
</section>

<section class="home_ancho py-5">
    <div class="titulo_home mb-4">
        <h2>Novedades y lo que esta por venir</h2>
    </div>

    <div class="product-scroll d-flex flex-nowrap overflow-auto pb-4 gap-4">
        <?php if (!empty($productosHome)): ?>
            <?php foreach ($productosHome as $item): ?>
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
        <?php else: ?>
            <p class="text-muted">No hay productos disponibles.</p>
        <?php endif; ?>
    </div>
</section>

<section class="home_triple_fondo_gris">
    <div class="home_triple">
        <div class="home_triple_fondo">
            <img src="assets/imagenes/tartabanner.png" alt="Banner de productos destacados">
        </div>

        <div class="home_triple_contenido">
            <div class="home_triple_caja">
                <article>
                    <img src="assets/imagenes/bowserchocobrownie3.png" alt="Bowser ChocoBrownie">
                    <h3>Bowser ChocoBrownie</h3>
                    <p>Brownie de chocolate inspirado en Bowser.</p>
                    <a href="index.php?controlador=ControladorProducto&accion=ver&id=5" class="btn btn-nintendo-red">Ya disponible</a>
                </article>

                <article>
                    <img src="assets/imagenes/pikaflan3.png" alt="Pikaflan Box">
                    <h3>Pikaflan Box</h3>
                    <p>Pack de flanes con sabor dulce y divertido.</p>
                    <a href="index.php?controlador=ControladorProducto&accion=ver&id=6" class="btn btn-nintendo-red">Ya disponible</a>
                </article>

                <article>
                    <img src="assets/imagenes/mariorol3.png" alt="Mario Bros Sweet Roll">
                    <h3>Mario Bros Sweet Roll</h3>
                    <p>Sweet roll inspirado en el mundo de Mario Bros.</p>
                    <a href="index.php?controlador=ControladorProducto&accion=ver&id=7" class="btn btn-nintendo-red">Ya disponible</a>
                </article>
            </div>
        </div>
    </div>
</section>
