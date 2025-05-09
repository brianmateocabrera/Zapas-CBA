<!DOCTYPE html>
<html lang="es">
	
<?php
// Encabezado del sitio (meta, enlaces CSS, scripts, etc.)
include_once 'head.php';
?>

<body>
<?php
// Contenido principal header
include_once 'header.php';

// Contenido principal ?>
<main class="container py-5 text-center">
  <?php
    // Detectar el código de error desde la URL o desde el estado actual
    $codigo_error = $_GET['error'] ?? http_response_code();

    // Mensajes personalizados según el código
    switch ($codigo_error) {
      case 404:
        $mensaje = "404. Página no encontrada";
        break;
      case 500:
        $mensaje = "500. Error interno del servidor";
        break;
      case 403:
        $mensaje = "403. Acceso denegado";
        break;
      case 401:
        $mensaje = "401. No autorizado";
        break;
      default:
        $mensaje = "Ha ocurrido un error";
        break;
    }
  ?>

  <h1>Error <?= $codigo_error ?></h1>
  <p><?= $mensaje ?></p>
  <a href="index.php" class="btn btn-primary mt-3">Volver al inicio</a>
</main><?php

// Pie de página
include_once 'footer.php';

// Menú lateral (offcanvas)
include_once 'offcanvas-menu.php';

?>
  <!-- Bootstrap JS (opcional, si usás componentes interactivos) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>