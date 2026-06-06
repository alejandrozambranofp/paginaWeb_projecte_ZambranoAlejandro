<?php
$filtroFranquicia = $_GET['franquicia'] ?? '';
$filtroTipo = $_GET['tipo'] ?? '';
$filtroOrden = $_GET['orden'] ?? '';
$filtroPrecio = $_GET['rango_precio'] ?? '';
$filtroOferta = isset($_GET['ofertas']) ? 'checked' : '';
$filtroAgotados = isset($_GET['agotados']) ? 'checked' : '';
?>

<div class="container py-5">
    <div class="titulo_pagina">
        <h1 class="h3">Catalogo Sweet Kingdom</h1>
        <p class="text-muted mb-0">Explora nuestros postres inspirados en Nintendo.</p>
    </div>

    <button type="button" class="btn btn-rojo boton_filtros_movil mb-3" aria-expanded="false">
        Filtros
    </button>

    <div class="row">
        <div class="col-lg-3 mb-5">
            <aside class="filtro_productos" id="panelFiltros">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="h5 fw-bold m-0">Filtrar y ordenar</h2>
                    <span class="ms-auto badge bg-light text-dark border">
                        <?php echo isset($productos) ? count($productos) : 0; ?> resultados
                    </span>
                </div>

                <form action="index.php" method="GET">
                    <input type="hidden" name="controlador" value="ControladorProducto">
                    <input type="hidden" name="accion" value="listar">

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="orden">Orden</label>
                        <select id="orden" name="orden" class="form-select py-2">
                            <option value="">Por defecto</option>
                            <option value="nuevo" <?php echo ($filtroOrden == 'nuevo') ? 'selected' : ''; ?>>Mas nuevo</option>
                            <option value="barato" <?php echo ($filtroOrden == 'barato') ? 'selected' : ''; ?>>Precio: menor a mayor</option>
                            <option value="caro" <?php echo ($filtroOrden == 'caro') ? 'selected' : ''; ?>>Precio: mayor a menor</option>
                        </select>
                    </div>

                    <div class="mb-3 p-3 rounded caja_ofertas d-flex align-items-center justify-content-between">
                        <label class="form-check-label small fw-bold pe-2" for="checkOfertas">Mostrar solo ofertas</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="ofertas" value="1" id="checkOfertas" <?php echo $filtroOferta; ?>>
                        </div>
                    </div>

                    <div class="mb-3 form-check p-3 border rounded bg-white">
                        <input class="form-check-input ms-0 me-2" type="checkbox" name="agotados" id="checkAgotados" <?php echo $filtroAgotados; ?>>
                        <label class="form-check-label text-muted small" for="checkAgotados">Ocultar productos agotados</label>
                    </div>

                    <div class="d-grid gap-3 mb-4">
                        <div>
                            <label class="form-label fw-bold" for="rango_precio">Rango de precio</label>
                            <select id="rango_precio" class="form-select py-2" name="rango_precio">
                                <option value="">Todos</option>
                                <option value="0-10" <?php echo ($filtroPrecio == '0-10') ? 'selected' : ''; ?>>Menos de 10&euro;</option>
                                <option value="10-20" <?php echo ($filtroPrecio == '10-20') ? 'selected' : ''; ?>>10&euro; - 20&euro;</option>
                                <option value="20-999" <?php echo ($filtroPrecio == '20-999') ? 'selected' : ''; ?>>Mas de 20&euro;</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label fw-bold" for="franquicia">Franquicia</label>
                            <select id="franquicia" class="form-select py-2" name="franquicia">
                                <option value="">Todas</option>
                                <option value="Mario" <?php echo ($filtroFranquicia == 'Mario') ? 'selected' : ''; ?>>Super Mario</option>
                                <option value="Zelda" <?php echo ($filtroFranquicia == 'Zelda') ? 'selected' : ''; ?>>Zelda</option>
                                <option value="Pokemon" <?php echo ($filtroFranquicia == 'Pokemon') ? 'selected' : ''; ?>>Pokemon</option>
                                <option value="Kirby" <?php echo ($filtroFranquicia == 'Kirby') ? 'selected' : ''; ?>>Kirby</option>
                                <option value="Animal" <?php echo ($filtroFranquicia == 'Animal') ? 'selected' : ''; ?>>Animal Crossing</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label fw-bold" for="tipo">Tipo de postre</label>
                            <select id="tipo" class="form-select py-2" name="tipo">
                                <option value="">Todos</option>
                                <option value="Tartas" <?php echo ($filtroTipo == 'Tartas') ? 'selected' : ''; ?>>Tartas</option>
                                <option value="Cupcakes" <?php echo ($filtroTipo == 'Cupcakes') ? 'selected' : ''; ?>>Cupcakes</option>
                                <option value="Postres" <?php echo ($filtroTipo == 'Postres') ? 'selected' : ''; ?>>Postres</option>
                                <option value="Ofertas" <?php echo ($filtroTipo == 'Ofertas') ? 'selected' : ''; ?>>Ofertas</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-rojo w-100 py-2 text-uppercase rounded">
                        Aplicar filtros
                    </button>

                    <div class="text-center mt-3">
                        <a href="index.php?controlador=ControladorProducto&accion=listar" class="text-muted small text-decoration-none">Limpiar filtros</a>
                    </div>
                </form>
            </aside>
        </div>

        <div class="col-lg-9">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $item): ?>
                        <div class="col">
                            <article class="card h-100 product-card shadow-sm position-relative">
                                <div class="bg-light text-center p-4 position-relative" style="min-height: 220px;">
                                    <?php if ((isset($item['oferta']) && $item['oferta'] == 1) || $item['categoria'] === 'Ofertas'): ?>
                                        <span class="badge bg-red position-absolute top-0 start-0 m-3 shadow-sm">OFERTA</span>
                                    <?php endif; ?>
                                    <a href="index.php?controlador=ControladorProducto&accion=ver&id=<?php echo $item['id_producto']; ?>" class="d-block h-100 d-flex align-items-center justify-content-center">
                                        <img src="assets/imagenes/<?php echo htmlspecialchars(preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $item['imagen'])); ?>" class="img-fluid" style="max-height: 160px; object-fit: contain;" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                                    </a>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <small class="text-muted text-uppercase fw-bold mb-2"><?php echo htmlspecialchars($item['categoria']); ?></small>
                                    <h3 class="h5 fw-bold mb-3">
                                        <a href="index.php?controlador=ControladorProducto&accion=ver&id=<?php echo $item['id_producto']; ?>" class="text-decoration-none text-dark">
                                            <?php echo htmlspecialchars($item['nombre']); ?>
                                        </a>
                                    </h3>

                                    <div class="mt-auto border-top pt-3">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="small text-muted">Precio</span>
                                            <span class="price-text"><?php echo number_format($item['precio'], 2); ?>&euro;</span>
                                        </div>

                                        <?php if ((int) ($item['stock'] ?? 0) > 0): ?>
                                            <a href="index.php?controlador=ControladorCarrito&accion=anadir&id=<?php echo $item['id_producto']; ?>" class="btn btn-rojo w-100 rounded py-2 text-uppercase boton_anadir_home">
                                                Anadir
                                            </a>
                                        <?php else: ?>
                                            <span class="btn btn-agotado w-100 rounded py-2 text-uppercase">Agotado</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 py-5 text-center">
                        <div class="bg-light rounded p-5 border">
                            <h3 class="text-muted">No hemos encontrado productos</h3>
                            <p class="text-muted">Prueba con otros filtros o vuelve al menu completo.</p>
                            <a href="index.php?controlador=ControladorProducto&accion=listar" class="btn btn-secundario mt-2">Ver todo el menu</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
var botonFiltros = document.querySelector('.boton_filtros_movil');
var panelFiltros = document.querySelector('#panelFiltros');

if (botonFiltros && panelFiltros) {
    botonFiltros.addEventListener('click', function () {
        panelFiltros.classList.toggle('filtros_abiertos');
        botonFiltros.setAttribute('aria-expanded', panelFiltros.classList.contains('filtros_abiertos') ? 'true' : 'false');
    });
}
</script>
