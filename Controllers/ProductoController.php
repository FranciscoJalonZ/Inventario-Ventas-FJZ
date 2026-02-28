<?php
require_once '../config/database.php';
require_once '../models/Producto.php';

class ProductoController {
    private $db;
    private $producto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
    }

    public function listar() {
        return $this->producto->read();
    }

    public function guardar($nombre, $precio, $stock) {
        $this->producto->nombre = $nombre;
        $this->producto->precio = $precio;
        $this->producto->stock = $stock;
        return $this->producto->create();
    }

    public function editar($id, $nombre, $precio, $stock) {
        $this->producto->id = $id;
        $this->producto->nombre = $nombre;
        $this->producto->precio = $precio;
        $this->producto->stock = $stock;
        return $this->producto->update();
    }

    public function eliminar($id) {
        $this->producto->id = $id;
        return $this->producto->delete();
    }
}
?>