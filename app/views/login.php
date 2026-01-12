<?php
//logon.php
?>

<div class="container login-page-container">
    <!-- Tarjeta principal con la clase personalizada de nuestro Canvas CSS -->
    <div class="card login-card shadow-lg" style="max-width: 450px; width: 100%;">
        
        <!-- Cabecera con fondo rojo Nintendo -->
        <div class="card-header login-header text-center py-3">
            <h2 class="h4 mb-0">
                <i class="bi bi-controller me-2"></i>ACCESO USUARIO
            </h2>
        </div>

        <div class="card-body p-4">
            
            <!-- Mensajes de Error de Autenticación -->
            <?php if (isset($_SESSION['error_login'])): ?>
                <div class="alert alert-danger text-center small animate__animated animate__shakeX">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i>
                    <?php 
                    echo htmlspecialchars($_SESSION['error_login']);
                    unset($_SESSION['error_login']); 
                    ?>
                </div>
            <?php endif; ?>

            <!-- Mensaje de éxito tras registro previo -->
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
                
                <!-- Campo de Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                    <div class="input-group login-input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="ejemplo@nintendo.es">
                    </div>
                </div>

                <!-- Campo de Contraseña -->
                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Contraseña</label>
                    <div class="input-group login-input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                    </div>
                </div>

                <!-- Botón de Acción Principal -->
                <button type="submit" class="btn btn-nintendo w-100 py-2 shadow-sm">
                    ¡VAMOS ALLÁ! <i class="bi bi-play-fill ms-1"></i>
                </button>
            </form>

            <!-- Pie del formulario para nuevos usuarios -->
            <div class="text-center mt-4 border-top pt-3">
                <p class="small mb-2 text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">¿Eres nuevo en Sweet Kingdom?</p>
                <a href="index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro" class="login-link-secondary">
                    CREAR UNA CUENTA NUEVA <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
</div>