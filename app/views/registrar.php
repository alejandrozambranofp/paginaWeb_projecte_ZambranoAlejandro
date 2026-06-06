<?php
// registrar.php
?>

<div class="container registro-page-container">
    <div class="card registro-card shadow-lg mx-auto" style="max-width: 500px; width: 100%;">
        <div class="card-header bg-danger text-white text-center py-3">
            <h2 class="h4 mb-0"><i class="bi bi-person-plus-fill me-2"></i>CREAR CUENTA</h2>
        </div>

        <div class="card-body p-4">
            <?php if (isset($_SESSION['error_registro'])): ?>
                <div class="alert alert-danger text-center small">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php
                    echo htmlspecialchars($_SESSION['error_registro']);
                    unset($_SESSION['error_registro']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="index.php?controlador=ControladorAutenticacion&accion=registro" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Tu nombre">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Correo electronico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="ejemplo@correo.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Contrasena</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required minlength="6">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label fw-bold">Confirmar contrasena</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-danger w-100 mt-3 py-2 fw-bold">
                    CREAR MI CUENTA <i class="bi bi-check-lg ms-1"></i>
                </button>
            </form>

            <div class="text-center mt-4 border-top pt-3">
                <p class="small mb-1 text-muted">Ya tienes una cuenta?</p>
                <a href="index.php?controlador=ControladorAutenticacion&accion=mostrarLogin" class="text-danger fw-bold text-decoration-none">
                    INICIAR SESION <i class="bi bi-box-arrow-in-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
