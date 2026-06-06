<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<footer class="bg-white pt-5 mt-5 border-top text-secondary">
    <div class="container">
        <div class="row row-cols-2 row-cols-md-4 g-4 mb-5 small">
            <div class="col">
                <h6 class="fw-bold text-uppercase text-dark mb-3">Productos</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="index.php?controlador=ControladorProducto&accion=listar" class="text-decoration-none text-secondary hover-red">Carta completa</a></li>
                    <li><a href="index.php?controlador=ControladorProducto&accion=categoria&tipo=Tartas" class="text-decoration-none text-secondary hover-red">Tartas</a></li>
                    <li><a href="index.php?controlador=ControladorProducto&accion=categoria&tipo=Cupcakes" class="text-decoration-none text-secondary hover-red">Cupcakes</a></li>
                    <li><a href="index.php?controlador=ControladorProducto&accion=listar&ofertas=1" class="text-decoration-none text-secondary hover-red">Ofertas</a></li>
                </ul>
            </div>

            <div class="col">
                <h6 class="fw-bold text-uppercase text-dark mb-3">Franquicias</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="index.php?controlador=ControladorProducto&accion=listar&franquicia=Mario" class="text-decoration-none text-secondary hover-red">Super Mario</a></li>
                    <li><a href="index.php?controlador=ControladorProducto&accion=listar&franquicia=Zelda" class="text-decoration-none text-secondary hover-red">The Legend of Zelda</a></li>
                    <li><a href="index.php?controlador=ControladorProducto&accion=listar&franquicia=Animal" class="text-decoration-none text-secondary hover-red">Animal Crossing</a></li>
                    <li><a href="index.php?controlador=ControladorProducto&accion=listar&franquicia=Kirby" class="text-decoration-none text-secondary hover-red">Kirby</a></li>
                </ul>
            </div>

            <div class="col">
                <h6 class="fw-bold text-uppercase text-dark mb-3">Atencion al cliente</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="#" class="text-decoration-none text-secondary hover-red">Ayuda</a></li>
                    <li><a href="#" class="text-decoration-none text-secondary hover-red">Contacto</a></li>
                    <li><a href="#" class="text-decoration-none text-secondary hover-red">Accesibilidad</a></li>
                    <li><a href="#" class="text-decoration-none text-secondary hover-red">Devoluciones</a></li>
                </ul>
            </div>

            <div class="col">
                <h6 class="fw-bold text-uppercase text-dark mb-3">Sweet Kingdom</h6>
                <p class="mb-2">Postres inspirados en videojuegos, pensados para fans y coleccionistas.</p>
                <p id="api_interna_resultado" class="small text-muted mb-1">Cargando API interna...</p>
                <p id="api_externa_resultado" class="small text-muted mb-3">Cargando API externa...</p>
                <a href="index.php?controlador=ControladorProducto&accion=listar" class="btn btn-secundario btn-sm rounded-pill px-3">Ver carta</a>
            </div>
        </div>
    </div>

    <div class="border-top py-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="m-0 small text-muted">&copy; 2026 Sweet Kingdom.</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-secondary hover-red" aria-label="Instagram"><i class="bi bi-instagram fs-5"></i></a>
                <a href="#" class="text-secondary hover-red" aria-label="Facebook"><i class="bi bi-facebook fs-5"></i></a>
                <a href="#" class="text-secondary hover-red" aria-label="YouTube"><i class="bi bi-youtube fs-5"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="js/api_interna.js?v=2"></script>
<script src="js/api_externa.js?v=2"></script>
<script src="js/carrito_ajax.js"></script>
</body>
</html>

