DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tienda;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(10,2),
    imagen VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(100),
    telefono VARCHAR(20),
    folio VARCHAR(20),
    fecha DATETIME,
    total DECIMAL(10,2)
);

CREATE TABLE IF NOT EXISTS detalle_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    producto_id INT,
    cantidad INT,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

INSERT INTO productos (nombre, precio, imagen) VALUES
('Producto 1', 10, 'prod1.jpg'),
('Producto 2', 11, 'prod2.jpg'),
('Producto 3', 12, 'prod3.jpg'),
('Producto 4', 13, 'prod4.jpg'),
('Producto 5', 14, 'prod5.jpg'),
('Producto 6', 15, 'prod6.jpg'),
('Producto 7', 16, 'prod7.jpg'),
('Producto 8', 17, 'prod8.jpg'),
('Producto 9', 18, 'prod9.jpg'),
('Producto 10', 19, 'prod10.jpg'),
('Producto 11', 20, 'prod11.jpg'),
('Producto 12', 21, 'prod12.jpg'),
('Producto 13', 22, 'prod13.jpg'),
('Producto 14', 23, 'prod14.jpg'),
('Producto 15', 24, 'prod15.jpg'),
('Producto 16', 25, 'prod16.jpg'),
('Producto 17', 26, 'prod17.jpg'),
('Producto 18', 27, 'prod18.jpg'),
('Producto 19', 28, 'prod19.jpg'),
('Producto 20', 29, 'prod20.jpg');

SHOW TABLES;
SELECT COUNT(*) AS Total_Productos FROM productos;


-- NUEVAS TABLAS 


CREATE TABLE ordenes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  folio VARCHAR(20) UNIQUE,
  total DECIMAL(10,2),
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orden_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  orden_id INT,
  producto_id INT,
  nombre VARCHAR(255),
  precio DECIMAL(10,2),
  cantidad INT
);

