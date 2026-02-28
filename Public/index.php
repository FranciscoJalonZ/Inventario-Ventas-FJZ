<?php
require_once 'config/database.php';
require_once 'models/Producto.php';

$db = (new Database())->getConnection();
$producto = new Producto($db);

// Lógica para crear
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear'])) {
    $producto->crear($_POST['nombre'], $_POST['precio'], $_POST['stock']);
    header("Location: index.php");
}

// Lógica para eliminar
if (isset($_GET['eliminar'])) {
    $producto->eliminar($_GET['eliminar']);
    header("Location: index.php");
}

$listaProductos = $producto->leer();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventario Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Gestión de Productos</h2>
    
    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
            <div class="col"><input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio (>0)" min="0.01" required></div>
            <div class="col"><input type="number" name="stock" class="form-control" placeholder="Stock (>=0)" min="0" required></div>
            <div class="col"><button type="submit" name="crear" class="btn btn-primary">Guardar</button></div>
        </div>
    </form>

    <table class="table table-bordered">
        <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>
        <?php foreach($listaProductos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['nombre'] ?></td>
            <td>$<?= $p['precio'] ?></td>
            <td><?= $p['stock'] ?></td>
            <td>
                <a href="?eliminar=<?= $p['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
<?php // Sistema de Inventario V1.0 - Elaborado por Francisco Jalon Z ?>