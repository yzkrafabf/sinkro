<?php
include 'db.php';
$data = !empty($_POST['pedido']) ? json_decode($_POST['pedido'], true) : [];$nombre = $_POST['nombre'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$folio = 'PED-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
$total = 0;

$conn->query("INSERT INTO pedidos (nombre_cliente, telefono, folio, fecha, total) VALUES ('$nombre', '$telefono', '$folio', NOW(), 0)");
$pedido_id = $conn->insert_id;

foreach ($data as $item) {
  $id = $item['id'];
  $cantidad = $item['cantidad'];
  $res = $conn->query("SELECT precio FROM productos WHERE id = $id");
  $precio = $res->fetch_assoc()['precio'];
  $subtotal = $precio * $cantidad;
  $total += $subtotal;
  $conn->query("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad) VALUES ($pedido_id, $id, $cantidad)");
}
$conn->query("UPDATE pedidos SET total = $total WHERE id = $pedido_id");
echo "¡Pedido generado! Tu folio es: <strong>$folio</strong>";
?>
