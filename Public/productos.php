<?php
require_once '../controllers/ProductoController.php';
$controller = new ProductoController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'eliminar') {
        $controller->eliminar($_POST['id']);
    } else {
        $controller->guardar($_POST['nombre'], $_POST['precio'], $_POST['stock']);
    }
    header("Location: productos.php");
}

$productos = $controller->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Nuevo Producto</h2>
    <form method="POST" class="mb-4">
        <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" class="form-control mb-2" required>
        <input type="number" name="stock" placeholder="Stock" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

    <h2>Inventario</h2>
    <table class="table table-bordered">
        <thead>
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php while ($row = $productos->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['precio']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="action" value="eliminar">
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="ventas.php" class="btn btn-link">Ir a Ventas</a>
</body>
</html>