CREATE DATABASE IF NOT EXISTS inventario_ventas;
USE inventario_ventas;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL CHECK (precio > 0),
    stock INT NOT NULL CHECK (stock >= 0)
);

INSERT INTO productos (nombre, precio, stock) VALUES ('Router', 85.50, 10);