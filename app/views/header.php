<?php
$ruta_base = '/paginaWeb_projecte_ZambranoAlejandro';
$usuario = $_SESSION['usuario_logueado'] ?? null;
$totalCarrito = !empty($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Kingdom</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/style.css?v=65">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_home.css?v=65">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_login.css?v=65">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_registro.css?v=65">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_carrito.css?v=65">
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>/css/estilo_productos.css?v=65">
</head>
<body>
    <header class="header">
        <div class="header_top">
            <div class="logo-container">
                <a href="<?php echo $ruta_base; ?>/index.php" aria-label="Ir al inicio">
                    <img class="header-logo" src="<?php echo $ruta_base; ?>/assets/imagenes/logo_header.svg" alt="Sweet Kingdom">
                </a>
            </div>

            <button class="boton_menu_movil" type="button" aria-label="Abrir menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="buscador" aria-label="Buscador de productos">
                <form class="d-flex w-100" role="search" action="index.php" method="GET">
                    <input type="hidden" name="controlador" value="ControladorProducto">
                    <input type="hidden" name="accion" value="buscar">
                    <input class="form-control" type="search" name="termino" placeholder="Busca tartas, cupcakes..." aria-label="Buscar productos">
                    <button class="botonlupa" type="submit" aria-label="Buscar">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </nav>

            <nav class="iconos_usuario_carrito" aria-label="Zona de usuario y carrito">
                <div class="enlaces_usuario">
                    <?php if ($usuario): ?>
                        <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorUsuario&accion=perfil">Mi cuenta</a>
                        <?php if (isset($usuario['rol']) && $usuario['rol'] === 'admin'): ?>
                            <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorAdmin&accion=panel">Admin</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorAutenticacion&accion=mostrarLogin">Iniciar sesion</a>
                        <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro">Registrarse</a>
                    <?php endif; ?>
                </div>

                <div class="position-relative">
                    <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorCarrito&accion=ver" aria-label="Ver carrito">
                        <img src="<?php echo $ruta_base; ?>/assets/imagenes/carrito.svg" alt="Carrito" width="28">
                        <?php if ($totalCarrito > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark border border-light" style="font-size: 0.6rem;">
                                <?php echo $totalCarrito; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            </nav>
        </div>

        <nav class="menu_movil" aria-label="Menu movil">
            <div class="menu_movil_usuario">
                <?php if ($usuario): ?>
                    <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorUsuario&accion=perfil">Mi cuenta</a>
                    <?php if (isset($usuario['rol']) && $usuario['rol'] === 'admin'): ?>
                        <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorAdmin&accion=panel">Admin</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorAutenticacion&accion=mostrarLogin">Iniciar sesion</a>
                    <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorAutenticacion&accion=mostrarRegistro">Registrarse</a>
                <?php endif; ?>
                <a href="<?php echo $ruta_base; ?>/index.php?controlador=ControladorCarrito&accion=ver">
                    Carrito<?php if ($totalCarrito > 0): ?> (<?php echo $totalCarrito; ?>)<?php endif; ?>
                </a>
            </div>

            <div class="menu_movil_links">
                <a href="index.php?controlador=ControladorProducto&accion=listar">Menu</a>
                <a href="index.php?controlador=ControladorProducto&accion=listar&ofertas=1">Ofertas</a>
                <a href="index.php?controlador=ControladorProducto&accion=especiales">Especiales</a>
                <a href="index.php?controlador=ControladorProducto&accion=novedades">Novedades</a>
            </div>
        </nav>

        <nav class="header_bottom" aria-label="Menu principal">
            <a href="index.php?controlador=ControladorProducto&accion=listar">Menu</a>
            <a href="index.php?controlador=ControladorProducto&accion=listar&ofertas=1">Ofertas</a>
            <a href="index.php?controlador=ControladorProducto&accion=especiales">Especiales</a>
            <a href="index.php?controlador=ControladorProducto&accion=novedades">Novedades</a>
        </nav>

        <div class="info">
            <div class="entrega">
                <img class="camion_entrega" src="<?php echo $ruta_base; ?>/assets/imagenes/camion_entrega.svg" alt="Icono de entrega">
                <p>Entrega gratuita a partir de 20&euro;</p>
            </div>
            <div class="entrega">
                <img class="camion_entrega" src="<?php echo $ruta_base; ?>/assets/imagenes/icono_regalo.svg" alt="Icono de regalo">
                <p>Todas tus franquicias favoritas</p>
            </div>
            <div class="entrega">
                <img class="camion_entrega" src="<?php echo $ruta_base; ?>/assets/imagenes/icono_exclusivo.svg" alt="Icono exclusivo">
                <p>Productos exclusivos</p>
            </div>
        </div>
    </header>

    <script>
        var botonMenu = document.querySelector('.boton_menu_movil');
        var menuMovil = document.querySelector('.menu_movil');

        if (botonMenu && menuMovil) {
            botonMenu.addEventListener('click', function () {
                menuMovil.classList.toggle('menu_movil_abierto');
                botonMenu.classList.toggle('boton_menu_abierto');
                botonMenu.setAttribute('aria-expanded', menuMovil.classList.contains('menu_movil_abierto') ? 'true' : 'false');
            });
        }
    </script>


