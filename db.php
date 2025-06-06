<?php
$conn = new mysqli('localhost', 'root', '', 'tienda');
if ($conn->connect_error) {
  die('Error de conexión: ' . $conn->connect_error);
}
?>