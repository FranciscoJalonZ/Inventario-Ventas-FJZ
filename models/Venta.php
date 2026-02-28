<?php
class Venta {
    private $conn;
    private $table_name = "ventas";

    public $id;
    public $producto_id;
    public $cantidad;
    public $fecha;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " SET producto_id=:producto_id, cantidad=:cantidad";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":producto_id", $this->producto_id);
        $stmt->bindParam(":cantidad", $this->cantidad);
        return $stmt->execute();
    }

    public function listar() {
        $query = "SELECT v.id, p.nombre, v.cantidad, v.fecha 
                  FROM " . $this->table_name . " v 
                  JOIN productos p ON v.producto_id = p.id 
                  ORDER BY v.fecha DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>