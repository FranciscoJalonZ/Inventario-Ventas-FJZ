<?php
require_once '../models/Producto.php';
require_once '../models/Venta.php';

class VentaService {
    private $db;
    private $producto;
    private $venta;

    public function __construct($db) {
        $this->db = $db;
        $this->producto = new Producto($this->db);
        $this->venta = new Venta($this->db);
    }

    public function realizarVenta($producto_id, $cantidad) {
        $this->db->beginTransaction();
        try {
            // Validar stock
            $this->producto->id = $producto_id;
            // Aquí iría una lógica para consultar el stock actual
            
            // Registrar venta
            $this->venta->producto_id = $producto_id;
            $this->venta->cantidad = $cantidad;
            $this->venta->registrar();

            // Actualizar stock del producto (Resta)
            $query = "UPDATE productos SET stock = stock - :cantidad WHERE id = :id AND stock >= :cantidad";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":cantidad", $cantidad);
            $stmt->bindParam(":id", $producto_id);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                throw new Exception("Stock insuficiente");
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
?>