<?php
require_once '../config/database.php';
require_once '../services/VentaService.php';
require_once '../models/Venta.php';

class VentaController {
    private $db;
    private $ventaService;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->ventaService = new VentaService($this->db);
    }

    public function ejecutarVenta($producto_id, $cantidad) {
        return $this->ventaService->realizarVenta($producto_id, $cantidad);
    }

    public function historial() {
        $venta = new Venta($this->db);
        return $venta->listar();
    }
}
?>