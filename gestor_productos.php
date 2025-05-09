<?php
// Gestor de Productos

// Conexión a la base de datos
include_once 'db.php'

// Obtener columnas de la tabla productos
$colsResult = $mysqli->query("SHOW COLUMNS FROM productos");
$columns = [];
while ($col = $colsResult->fetch_assoc()) {
    $columns[] = $col['Field'];
}

// Obtener registros de productos
$prodResult = $mysqli->query("SELECT * FROM productos");
$productos = $prodResult->fetch_all(MYSQLI_ASSOC);
?><!DOCTYPE html><html lang="es">
<?php include_once 'head.php'; ?>
<body>
<?php include_once 'header.php'; ?><main class="container py-4">

    <!-- Área Superior: Tabla de Productos -->
    <div class="table-responsive mb-4">
        <table id="tabla-productos" class="table table-striped table-bordered">
            <thead>
                <tr>
<?php foreach ($columns as $field): ?>
                    <th><?= htmlspecialchars(ucfirst($field)) ?></th>
<?php endforeach; ?>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($productos as $prod): ?>
                <tr data-id="<?= $prod['<?= $columns[0] ?>'] ?>">
<?php foreach ($columns as $field): ?>
                    <td><?= htmlspecialchars($prod[$field]) ?></td>
<?php endforeach; ?>
                    <td>
                        <button class="btn btn-sm btn-primary btn-seleccionar">Seleccionar</button>
                    </td>
                </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Área Inferior: Botones de Acción -->
<div class="d-flex gap-2">
    <button id="btnNuevo" class="btn btn-success">Nuevo</button>
    <button id="btnEditar" class="btn btn-warning" disabled>Editar</button>
    <button id="btnBorrar" class="btn btn-danger" disabled>Borrar</button>
</div>

</main>

<?php include_once 'footer.php'; ?>

<?php include_once 'offcanvas-menu.php'; ?>

<?php include_once 'offcanvas-filtros.php'; ?>

<!-- Modals CRUD -->

<!-- Modal: Crear/Editar Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProductoLabel">Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formProducto">
      <div class="modal-body">
<?php foreach ($columns as $field): ?>
        <div class="mb-3">
          <label for="campo_<?= $field ?>" class="form-label"><?= ucfirst($field) ?></label>
          <input type="text" class="form-control" id="campo_<?= $field ?>" name="<?= $field ?>">
        </div>
<?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Confirmar Borrado --><div class="modal fade" id="modalBorrar" tabindex="-1" aria-labelledby="modalBorrarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBorrarLabel">Confirmar Borrado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro que deseas borrar el producto seleccionado?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button id="confirmarBorrar" type="button" class="btn btn-danger">Borrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#tabla-productos').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' }
    });

    var selectedRow = null;
    $('#tabla-productos tbody').on('click', '.btn-seleccionar', function() {
        if (selectedRow) $(selectedRow).removeClass('table-active');
        selectedRow = $(this).closest('tr');
        selectedRow.addClass('table-active');
        $('#btnEditar, #btnBorrar').prop('disabled', false);
    });

    $('#btnNuevo').click(function() {
        $('#modalProductoLabel').text('Nuevo Producto');
        $('#formProducto')[0].reset();
        $('#modalProducto').modal('show');
    });

    $('#btnEditar').click(function() {
        if (!selectedRow) return;
        $('#modalProductoLabel').text('Editar Producto');
        var data = table.row(selectedRow).data();
<?php foreach ($columns as $i => $field): ?>
        $('#campo_<?= $field ?>').val(data[<?= $i ?>]);
<?php endforeach; ?>
        $('#modalProducto').modal('show');
    });

    $('#btnBorrar').click(function() {
        if (!selectedRow) return;
        $('#modalBorrar').modal('show');
    });

    $('#confirmarBorrar').click(function() {
        var id = selectedRow.data('id');
       
       // AJAX para borrar
        $.post('producto_borrar.php', { id: id }, function(resp) {
            location.reload();
        });
    });

    $('#formProducto').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var url = ($('#modalProductoLabel').text().includes('Nuevo')) ? 'producto_crear.php' : 'producto_editar.php?id=' + selectedRow.data('id');
        $.post(url, formData, function(resp) {
            location.reload();
        });
    });
});
</script>

</body>
</html>