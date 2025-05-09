<?php
// Conexión a la base de datos
include_once 'db.php'
?>
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

// Contenido principal
include_once '';

// Pie de página
include_once 'footer.php';

// Menú lateral (offcanvas)
include_once 'offcanvas-menu.php';

// Filtros laterales (offcanvas)
include_once 'offcanvas-filtros.php';

// Modal para detalles de producto
include_once 'modal-detalle.php';

?>
  <!-- Bootstrap JS (opcional, si usás componentes interactivos) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery (requerido por DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <!-- Esperar que el DOM esté listo y activar DataTables -->
  <script>
  $(document).ready(function() {
    $('#tabla-productos').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
      }
    });
  });
  </script>

</body>
</html>