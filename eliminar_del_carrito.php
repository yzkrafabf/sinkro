<?php
session_start();

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
        echo json_encode(['status' => 'ok', 'mensaje' => 'Producto eliminado']);
    } else {
        echo json_encode(['status' => 'error', 'mensaje' => 'Producto no encontrado en el carrito']);
    }
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'ID no recibido']);
}
