<?php
require_once '../controllers/VentaController.php';
require_once '../controllers/ProductoController.php';

$ventaCtrl = new VentaController();
$prodCtrl = new ProductoController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ventaCtrl->ejecutarVenta($_POST['producto_id'], $_POST['cantidad']);
    header("Location: ventas.php");
}

$productos = $prodCtrl->listar();
$historial = $ventaCtrl->historial();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Registrar Venta</h2>
    <form method="POST" class="mb-4">
        <select name="producto_id" class="form-select mb-2">
            <?php while ($p = $productos->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?> (Stock: <?php echo $p['stock']; ?>)</option>
            <?php endwhile; ?>
        </select>
        <input type="number" name="cantidad" placeholder="Cantidad" class="form-control mb-2" required>
        <button type="submit" class="btn btn-success">Vender</button>
    </form>

    <h2>Historial de Ventas</h2>
    <table class="table table-striped">
        <thead><tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Fecha</th></tr></thead>
        <tbody>
            <?php while ($v = $historial->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $v['id']; ?></td>
                <td><?php echo $v['nombre']; ?></td>
                <td><?php echo $v['cantidad']; ?></td>
                <td><?php echo $v['fecha']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="productos.php" class="btn btn-link">Volver a Productos</a>
</body>
</html>