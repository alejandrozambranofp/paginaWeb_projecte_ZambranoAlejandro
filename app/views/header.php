<?php
//header.php
// Definimos la ruta base para no tener errores de carga
$ruta_base = '/paginaWeb_projecte_ZambranoAlejandro';
$usuario = $_SESSION['usuario_logueado'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Kingdom</title>
    
    <!-- Iconos y Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- TUS ESTILOS ORIGINALES -->
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/style.css"> 
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_home.css">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_login.css">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_registro.css">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_carrito.css">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_productos.css">

</head>
<body>
    <header class="header">
        <div class="header_top">
            <div class="logo-container">
                <a href="<?php echo $ruta_base; ?>/index.php">
                    <img class="header-logo" src="<?php echo $ruta_base; ?>/assets/imagenes/logo_header.png" alt="Sweet Kingdom Logo" style="max-width: 150px; height: auto;">
                </a>
            </div>  

            <nav class="buscador">
                <div class="container-fluid px-0">
                    <!-- Buscador funcional: envía el término al ControladorProducto -->
                    <form class="d-flex w-100" role="search" action="index.php" method="GET">
                        <input type="hidden" name="controlador" value="ControladorProducto">
                        <input type="hidden" name="accion" value="buscar">
                        <input class="form-control" type="search" name="termino" placeholder="¡Busca tartas, cupcakes..." aria-label="Search"/>
                        <button class="botonlupa" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </nav>

            <nav class="iconos_usuario_carrito pe-3"> <div class="d-flex align-items-center justify-content-end gap-1"> 
                    
                    <div class="d-flex align-items-center gap-1 border-end pe-2 me-1" style="border-color: rgba(255,255,255,0.3) !important;">
                        <?php if ($usuario): ?>
                            <span class="text-white small">
                                Hola, <?php echo htmlspecialchars($usuario['nombre']); ?>
                            </span>

                            <a href="<?= $ruta_base ?>/index.php?controlador=ControladorUsuario&accion=perfil" class="text-white ms-2 small fw-bold text-decoration-none">
                                Mi cuenta
                            </a>

                            <?php if (isset($usuario['rol']) && $usuario['rol'] === 'admin'): ?>
                                <a href="<?= $ruta_base ?>/index.php?controlador=ControladorAdmin&accion=panel" class="text-white ms-2 small fw-bold text-decoration-none">
                                    Admin
                                </a>
                            <?php endif; ?>

                            <a href="<?= $ruta_base ?>/index.php?controlador=ControladorAutenticacion&accion=logout" class="text-white ms-1">
                        <?php else: ?>
                            <a href="<?= $ruta_base ?>/index.php?controlador=ControladorAutenticacion&accion=mostrarLogin">
                                <img src="<?= $ruta_base ?>/assets/imagenes/icono_usuario.png" alt="Login" width="24">
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="position-relative">
                        <a href="<?= $ruta_base ?>/index.php?controlador=ControladorCarrito&accion=ver">
                            <img src="<?= $ruta_base ?>/assets/imagenes/carrito.png" alt="Carrito" width="26">
                            <?php if (!empty($_SESSION['carrito'])): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark border border-light" style="font-size: 0.6rem;">
                                    <?= array_sum($_SESSION['carrito']) ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>

                </div>
            </nav>
        </div>

        <div class="header_bottom">
            <div>
                <a href="index.php?controlador=ControladorProducto&accion=listar"><b>Todos</b></a>
            </div>

            <div><a href="index.php?controlador=ControladorProducto&accion=categoria&tipo=Tartas"><b>Tartas</b></a></div>
            <div><a href="index.php?controlador=ControladorProducto&accion=categoria&tipo=Cupcakes"><b>Cupcakes</b></a></div>
            
            <div><a href="index.php?controlador=ControladorProducto&accion=categoria&tipo=Ofertas"><b>Ofertas</b></a></div>
            
            <div><a href="index.php?controlador=ControladorProducto&accion=categoria&tipo=Postres"><b>Postres</b></a></div>
        </div>

        <div class="info">
            <div class="entrega">
                <img class="camion_entrega" src="<?php echo $ruta_base; ?>/assets/imagenes/camion_entrega.png" alt="Entrega">
                <p>Entrega gratuita a partir de 20€</p>
            </div>
            <div class="entrega">
                <img class="camion_entrega" src="<?php echo $ruta_base; ?>/assets/imagenes/icono_regalo.png" alt="Entrega">
                <p>Todas tus franquicias favoritas en postres</p>
            </div>
            <div class="entrega">
                <img class="camion_entrega" src="<?php echo $ruta_base; ?>/assets/imagenes/icono_exclusivo.png" alt="Entrega">
                <p>Productos totalmente exclusivos</p>
            </div>
        </div>
        
    </header>