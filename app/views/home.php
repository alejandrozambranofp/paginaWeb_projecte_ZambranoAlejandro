<?php
/**
 * home.php
 * Vista principal: Carrusel a pantalla completa y lista de productos en slider.
 */
?>

<div id="carouselSweetKingdom" class="carousel slide shadow-sm mb-5" data-bs-ride="carousel" 
     style="width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; overflow: hidden;">
    
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="assets/imagenes/banner-zelda.jpg" class="d-block w-100" alt="Zelda Banner" style="height: 500px; object-fit: cover; object-position: center;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-4 p-4 mb-5 shadow-lg" style="max-width: 700px; margin: 0 auto;">
                <h2 class="display-5 fw-bold text-white">The Legend of Zelda</h2>
                <p class="lead text-white-50">Descubre los postres inspirados en el vasto reino de Hyrule.</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
            <img src="assets/imagenes/banner-mariokart.jpg" class="d-block w-100" alt="Mario Kart Banner" style="height: 500px; object-fit: cover; object-position: center;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-4 p-4 mb-5 shadow-lg" style="max-width: 700px; margin: 0 auto;">
                <h2 class="display-5 fw-bold text-white">Mario Kart World</h2>
                <p class="lead text-white-50">¡Power-up! Sabores que te harán sentir en la pista de Rainbow Road.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselSweetKingdom" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<div class="container pb-5">

    <?php if (isset($_SESSION['usuario_logueado'])): ?>
        <div class="alert alert-light border shadow-sm d-flex justify-content-between align-items-center mb-5 rounded-pill px-4">
            <span class="text-secondary"><i class="bi bi-stars text-pink"></i> ¡Hola de nuevo, <strong><?php echo htmlspecialchars($_SESSION['usuario_logueado']['nombre']); ?></strong>!</span>
            <span class="badge bg-success rounded-pill px-3">En línea</span>
        </div>
    <?php endif; ?>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center bg-white shadow-sm border rounded p-4 mb-4">
        <h3 class="fw-bold m-0 text-dark text-center text-md-start mb-3 mb-md-0">
            Postres: The Legend of Zelda Tears of the Kingdom
        </h3>
        <a href="#" class="btn btn-nintendo-red fw-bold rounded-1 px-4 py-2 text-uppercase" style="letter-spacing: 0.5px;">
            Ya Disponible
        </a>
    </div>

    <div class="row justify-content-center mb-5 gx-3 gy-3">
        <div class="col-6 col-md-3">
            <a href="#" class="text-decoration-none text-dark">
                <div class="bg-white border shadow-sm p-3 text-center rounded h-100 hover-effect">
                    <img src="assets/imagenes/franquicias.png" alt="Franquicias" class="mb-2" style="height: 40px; width: auto;">
                    <h6 class="m-0 small fw-bold text-uppercase">Franquicias</h6>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="index.php?controlador=ControladorProducto&accion=listar" class="text-decoration-none text-dark">
                <div class="bg-white border shadow-sm p-3 text-center rounded h-100 hover-effect">
                    <img src="assets/imagenes/menu.png" alt="Menú" class="mb-2" style="height: 40px; width: auto;">
                    <h6 class="m-0 small fw-bold text-uppercase">Menú</h6>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="#" class="text-decoration-none text-dark">
                <div class="bg-white border shadow-sm p-3 text-center rounded h-100 hover-effect">
                    <img src="assets/imagenes/especiales.png" alt="Especiales" class="mb-2" style="height: 40px; width: auto;">
                    <h6 class="m-0 small fw-bold text-uppercase">Especiales</h6>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="#" class="text-decoration-none text-dark">
                <div class="bg-white border shadow-sm p-3 text-center rounded h-100 hover-effect">
                    <img src="assets/imagenes/mascomprado.png" alt="Mas Comprado" class="mb-2" style="height: 40px; width: auto;">
                    <h6 class="m-0 small fw-bold text-uppercase">Más Comprado</h6>
                </div>
            </a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-lg-3 g-4 mb-5">
        
        <div class="col">
            <div class="card border-0 shadow-sm h-100 overflow-hidden bg-white">
                <div class="row g-0 h-100">
                    <div class="col-7 p-3 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold mb-2">Mario Kart World</h5>
                        <p class="small text-muted mb-2 lh-sm">Están disponibles varios packs de Mario Kart World que incluyen postres y detalles exclusivos.</p>
                        <a href="#" class="text-decoration-none small fw-bold text-pink">
                            Échales un ojo <i class="bi bi-caret-right-fill"></i>
                        </a>
                    </div>
                    <div class="col-5">
                        <img src="assets/imagenes/mariopower3.png" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Mario Kart">
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm h-100 overflow-hidden bg-white">
                <div class="row g-0 h-100">
                    <div class="col-7 p-3 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold mb-2">Animal Crossing</h5>
                        <p class="small text-muted mb-2 lh-sm">Están disponibles varios packs de Animal Crossing que incluyen postres y detalles exclusivos.</p>
                        <a href="#" class="text-decoration-none small fw-bold text-pink">
                            Échales un ojo <i class="bi bi-caret-right-fill"></i>
                        </a>
                    </div>
                    <div class="col-5">
                        <img src="assets/imagenes/ac3.png" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Animal Crossing">
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm h-100 overflow-hidden bg-white">
                <div class="row g-0 h-100">
                    <div class="col-7 p-3 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold mb-2">The Legend of Zelda</h5>
                        <p class="small text-muted mb-2 lh-sm">Están disponibles varios packs de Zelda: Link's Awakening que incluyen postres exclusivos.</p>
                        <a href="#" class="text-decoration-none small fw-bold text-pink">
                            Échales un ojo <i class="bi bi-caret-right-fill"></i>
                        </a>
                    </div>
                    <div class="col-5">
                        <img src="assets/imagenes/linksweet3.png" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Zelda">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center mb-5">
        <h2 class="h2 fw-bold mb-0 text-uppercase tracking-tight">Nuestra Carta</h2>
        <div class="flex-grow-1 ms-4 border-bottom border-2" style="border-color: #E60012 !important; opacity: 1;"></div>
    </div>

    <style>
        .product-scroll::-webkit-scrollbar { height: 10px; }
        .product-scroll::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .product-scroll::-webkit-scrollbar-thumb { background: #E60012; border-radius: 10px; } /* Rojo Nintendo */
        .product-scroll::-webkit-scrollbar-thumb:hover { background: #c40010; }
    </style>

    <div class="product-scroll d-flex flex-nowrap overflow-auto pb-4 gap-4 px-2" style="scroll-behavior: smooth;">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $item): ?>
                <div class="flex-shrink-0 col-10 col-md-5 col-lg-3">
                    <div class="card h-100 product-card border-0 shadow-sm overflow-hidden bg-white">
                        <div class="position-relative overflow-hidden bg-light">
                            <img src="assets/imagenes/<?php echo $item['imagen']; ?>" 
                                 class="card-img-top p-4" 
                                 alt="<?php echo htmlspecialchars($item['nombre']); ?>"
                                 onerror="this.src='https://placehold.co/400x400/f8f9fa/E60012?text=Sweet+Kingdom';">
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-pink rounded-pill shadow-sm px-3">
                                    <?php echo htmlspecialchars($item['categoria']); ?>
                                </span>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column text-center p-4">
                            <h5 class="card-title fw-bold text-dark mb-2"><?php echo htmlspecialchars($item['nombre']); ?></h5>
                            <p class="card-text text-muted small flex-grow-1 text-truncate" style="max-height: 3em; white-space: normal;">
                                <?php echo htmlspecialchars($item['descripcion']); ?>
                            </p>
                            <div class="mt-3">
                                <span class="price-tag"><?php echo number_format($item['precio'], 2); ?>€</span>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0 pb-4 px-4">
                            <a href="index.php?controlador=ControladorCarrito&accion=añadir&id=<?php echo $item['id_producto']; ?>" 
                               class="btn btn-nintendo-pink w-100 rounded-pill shadow-sm py-2">
                                <i class="bi bi-cart-plus me-2"></i>AÑADIR
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5 w-100">
                <div class="bg-light rounded-5 p-5 border w-100">
                    <i class="bi bi-emoji-frown text-muted display-1"></i>
                    <h3 class="mt-4 fw-bold">No hay productos</h3>
                    <p class="text-muted">Parece que nuestro reino se ha quedado sin stock temporalmente.</p>
                    <a href="index.php" class="btn btn-outline-danger rounded-pill px-4 mt-2">Refrescar carta</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<section class="position-relative w-100" style="margin-bottom: 100px;">
    
    <div class="w-100 d-flex align-items-center justify-content-center overflow-hidden" 
         style="background-color: #E60012; height: 400px; position: relative;">
        
        <img src="assets/imagenes/tartabanner.png" 
             alt="Zelda Background" 
             class="w-100 h-100" 
             style="object-fit: cover; opacity: 1;"> 
    </div>

    <div class="container" style="margin-top: -150px; position: relative; z-index: 10;">
        <div class="bg-white shadow-lg p-5 rounded-1">
            <div class="row text-center align-items-start">
                
                <div class="col-12 col-md-4 mb-5 mb-md-0 border-end-md">
                    <img src="assets/imagenes/bowserchocobrownie3.png" 
                         class="img-fluid mb-3" 
                         style="max-height: 180px; width: auto;" 
                         alt="Bowser Brownie">
                    
                    <h5 class="fw-bold text-uppercase mt-3 mb-2" style="font-size: 1.1rem;">BOWSER CHOCOBROWNIE</h5>
                    
                    <p class="small text-muted mb-4 px-3">
                        ¡Ya esta aqui el brownie de chocolate inspirado en bowser!
                    </p>
                    
                    <a href="#" class="btn btn-nintendo-red rounded-1 px-4 py-2 fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">
                        YA DISPONIBLE
                    </a>
                </div>

                <div class="col-12 col-md-4 mb-5 mb-md-0 border-end-md">
                    <img src="assets/imagenes/pikaflan3.png" 
                         class="img-fluid mb-3" 
                         style="max-height: 180px; width: auto;" 
                         alt="Pikaflan Box">
                    
                    <h5 class="fw-bold text-uppercase mt-3 mb-2" style="font-size: 1.1rem;">PIKAFLAN BOX</h5>
                    
                    <p class="small text-muted mb-4 px-3">
                        ¡Ya esta aqui el nuevo box con 6 pikaflans con un sabor elictricante!
                    </p>
                    
                    <a href="#" class="btn btn-nintendo-red rounded-1 px-4 py-2 fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">
                        YA DISPONIBLE
                    </a>
                </div>

                <div class="col-12 col-md-4">
                    <img src="assets/imagenes/mariorol3.png" 
                         class="img-fluid mb-3" 
                         style="max-height: 180px; width: auto;" 
                         alt="Mario Sweet Roll">
                    
                    <h5 class="fw-bold text-uppercase mt-3 mb-2" style="font-size: 1.1rem;">MARIO BROS SWEET ROLL</h5>
                    
                    <p class="small text-muted mb-4 px-3">
                        ¡Ya esta aqui el nuevo sweet roll con forma de tubo de Mario Bros!
                    </p>
                    
                    <a href="#" class="btn btn-nintendo-red rounded-1 px-4 py-2 fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">
                        YA DISPONIBLE
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>