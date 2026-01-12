<?php
// app/views/productos.php

// Recuperamos los filtros
$filtroFranquicia = $_GET['franquicia'] ?? '';
$filtroTipo       = $_GET['tipo'] ?? '';
$filtroOrden      = $_GET['orden'] ?? '';
$filtroPrecio     = $_GET['rango_precio'] ?? '';
$filtroOferta     = isset($_GET['ofertas']) ? 'checked' : '';
$filtroAgotados   = isset($_GET['agotados']) ? 'checked' : '';
?>

<div class="container py-5">
    <div class="row">
        
        <div class="col-lg-3 mb-5">
            
            <div class="d-flex align-items-center mb-3">
                <h5 class="fw-bold m-0">Filtrar y ordenar</h5>
                <span class="ms-auto badge bg-light text-dark border">
                    <?php echo isset($productos) ? count($productos) : 0; ?> Resultados
                </span>
            </div>

            <form action="index.php" method="GET">
                <input type="hidden" name="controlador" value="ControladorProducto">
                <input type="hidden" name="accion" value="listar">

                <div class="mb-3">
                    <select name="orden" class="form-select rounded-3 py-2">
                        <option value="">Orden: Por defecto</option>
                        <option value="barato" <?php echo ($filtroOrden == 'barato') ? 'selected' : ''; ?>>Precio: Menor a Mayor</option>
                        <option value="caro" <?php echo ($filtroOrden == 'caro') ? 'selected' : ''; ?>>Precio: Mayor a Menor</option>
                    </select>
                </div>

                <div class="mb-3 p-3 rounded-3 text-white d-flex align-items-center justify-content-between" style="background-color: #E60012;">
                    <label class="form-check-label small fw-bold lh-sm pe-2" for="checkOfertas">
                        Mostrar solo ofertas
                    </label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="ofertas" value="1" id="checkOfertas" style="transform: scale(1.3);" <?php echo $filtroOferta; ?>>
                    </div>
                </div>

                <div class="mb-3 form-check p-3 border rounded-3 bg-white">
                    <input class="form-check-input ms-0 me-2" type="checkbox" name="agotados" id="checkAgotados" <?php echo $filtroAgotados; ?>>
                    <label class="form-check-label text-muted small" for="checkAgotados">
                        Ocultar productos agotados
                    </label>
                </div>

                <div class="d-grid gap-2 mb-4">
                    <select class="form-select py-2 text-muted" name="rango_precio">
                        <option value="">Rango de Precio</option>
                        <option value="0-10"   <?php echo ($filtroPrecio == '0-10') ? 'selected' : ''; ?>>Menos de 10€</option>
                        <option value="10-20"  <?php echo ($filtroPrecio == '10-20') ? 'selected' : ''; ?>>10€ - 20€</option>
                        <option value="20-50"  <?php echo ($filtroPrecio == '20-50') ? 'selected' : ''; ?>>Más de 20€</option>
                    </select>

                    <select class="form-select py-2 text-muted" name="franquicia">
                        <option value="">Franquicia</option>
                        <option value="Mario"   <?php echo ($filtroFranquicia == 'Mario') ? 'selected' : ''; ?>>Super Mario</option>
                        <option value="Zelda"   <?php echo ($filtroFranquicia == 'Zelda') ? 'selected' : ''; ?>>Zelda</option>
                        <option value="Pokemon" <?php echo ($filtroFranquicia == 'Pokemon') ? 'selected' : ''; ?>>Pokémon</option>
                        <option value="Kirby"   <?php echo ($filtroFranquicia == 'Kirby') ? 'selected' : ''; ?>>Kirby</option>
                    </select>

                    <select class="form-select py-2 text-muted" name="tipo">
                        <option value="">Tipo de postre</option>
                        <option value="Tarta"   <?php echo ($filtroTipo == 'Tarta') ? 'selected' : ''; ?>>Tartas</option>
                        <option value="Cupcake" <?php echo ($filtroTipo == 'Cupcake') ? 'selected' : ''; ?>>Cupcakes</option>
                        <option value="Bebida"  <?php echo ($filtroTipo == 'Bebida') ? 'selected' : ''; ?>>Bebidas</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm text-uppercase">
                    Aplicar filtros
                </button>
                
                <div class="text-center mt-2">
                    <a href="index.php?controlador=ControladorProducto&accion=listar" class="text-muted small text-decoration-none">
                        Limpiar filtros
                    </a>
                </div>
            </form>
        </div>

        <div class="col-lg-9">
            
            <div class="mb-4 border-bottom pb-2">
                <h2 class="h2 fw-bold mb-1">Catálogo Sweet Kingdom</h2>
                <p class="text-muted small">Explora nuestros postres inspirados en Nintendo.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $item): ?>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm hover-effect position-relative">
                                
                                <div class="bg-light text-center p-4 position-relative" style="border-radius: 8px 8px 0 0; min-height: 220px;">
                                    <?php if(isset($item['oferta']) && $item['oferta'] == 1): ?>
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 shadow-sm">OFERTA</span>
                                    <?php endif; ?>

                                    <a href="index.php?controlador=ControladorProducto&accion=ver&id=<?php echo $item['id_producto']; ?>" class="d-block h-100 d-flex align-items-center justify-content-center">
                                        <img src="assets/imagenes/<?php echo $item['imagen']; ?>" 
                                             class="img-fluid" 
                                             style="max-height: 160px; object-fit: contain;"
                                             alt="<?php echo $item['nombre']; ?>">
                                    </a>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">
                                            <?php echo isset($item['categoria']) ? $item['categoria'] : 'Postre'; ?>
                                        </small>
                                    </div>

                                    <h5 class="fw-bold mb-3 text-dark" style="font-size: 1.1rem;">
                                        <a href="index.php?controlador=ControladorProducto&accion=ver&id=<?php echo $item['id_producto']; ?>" class="text-decoration-none text-dark">
                                            <?php echo $item['nombre']; ?>
                                        </a>
                                    </h5>
                                    
                                    <div class="d-flex justify-content-between align-items-end border-top pt-3 mt-auto">
                                        <span class="small text-muted">Precio ud.</span>
                                        <span class="fw-bold fs-5 text-danger">
                                            <?php echo number_format($item['precio'], 2); ?>€
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                
                <?php else: ?>
                    <div class="col-12 py-5 text-center">
                        <div class="bg-light rounded-3 p-5">
                            <h3 class="text-muted">¡Vaya!</h3>
                            <p class="text-muted">No hemos encontrado productos con esos filtros.</p>
                            <a href="index.php?controlador=ControladorProducto&accion=listar" class="btn btn-outline-dark mt-2">Ver todo el menú</a>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>