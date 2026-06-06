<?php
// login.php
?>

<div class="container login-page-container">
    <div class="card login-card shadow-lg" style="max-width: 450px; width: 100%;">
        <div class="card-header login-header text-center py-3">
            <h2 class="h4 mb-0">
                <i class="bi bi-controller me-2"></i>ACCESO USUARIO
            </h2>
        </div>

        <div class="card-body p-4">
            <?php if (isset($_SESSION['error_login'])): ?>
                <div class="alert alert-danger text-center small animate__animated animate__shakeX">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i>
                    <?php
                    echo htmlspecialchars($_SESSION['error_login']);
                    unset($_SESSION['error_login']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_registro'])): ?>
                <div class="alert alert-success text-center small">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php
                    echo htmlspecialchars($_SESSION['success_registro']);
                    unset($_SESSION['success_registro']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="index.php?controlador=ControladorAutenticacion&accion=login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Correo electronico</label>
                    <div class="input-group login-input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="ejemplo@correo.com">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Contrasena</label>
                    <div class="input-group login-input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="********">
                    </div>
                </div>

                <button type="submit" class="btn btn-nintendo w-100 py-2 shadow-sm">
                    ENTRAR <i class="bi bi-play-fill ms-1"></i>
                </button>
            </form>

            <div class="text-center mt-4 border-top pt-3">
                <p class="small mb-2 text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Eres nuevo en Sweet Kingdom?</p>
                <a href="index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro" class="login-link-secondary">
                    CREAR UNA CUENTA NUEVA <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
</div>
