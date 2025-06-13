<?php
session_start();

if (isset($_POST['id']) && isset($_POST['accion'])) {
    $id = intval($_POST['id']);
    $accion = $_POST['accion'];

    if (isset($_SESSION['carrito'][$id])) {
        if ($accion === 'incrementar') {
            $_SESSION['carrito'][$id]['cantidad'] += 1;
        } elseif ($accion === 'disminuir') {
            $_SESSION['carrito'][$id]['cantidad'] -= 1;
            if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$id]);
            }
        }
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'error', 'mensaje' => 'Producto no encontrado en el carrito']);
    }
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'Datos incompletos']);
}
