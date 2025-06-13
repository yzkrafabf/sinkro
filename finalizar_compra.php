<?php
session_start();
include 'db.php';

if (empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

$userId = $_SESSION['id'] ?? null;
$carrito = $_SESSION['carrito'];

$folio = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 20);
$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Inserta la orden con estado_de_orden 'en proceso'
$stmt = $conn->prepare("INSERT INTO ordenes (usuario_id, folio, total, estado_de_orden) VALUES (?, ?, ?, 'en proceso')");
if (!$stmt) {
    die("Error en prepare (ordenes): " . $conn->error);
}
$stmt->bind_param("isd", $userId, $folio, $total);
$stmt->execute();
$ordenId = $stmt->insert_id;
$stmt->close();

// Inserta los productos del pedido
$stmtItems = $conn->prepare("INSERT INTO orden_items (orden_id, producto_id, nombre, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
if (!$stmtItems) {
    die("Error en prepare (orden_items): " . $conn->error);
}
foreach ($carrito as $item) {
    $stmtItems->bind_param("iisdi", $ordenId, $item['id'], $item['nombre'], $item['precio'], $item['cantidad']);
    $stmtItems->execute();
}
$stmtItems->close();

unset($_SESSION['carrito']);
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Orden generada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .ticket {
            max-width: 600px;
            margin: 60px auto;
            border: 1px dashed #ccc;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .ticket h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .ticket .folio {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-bottom: 25px;
        }

        .ticket table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .ticket th {
            text-align: left;
            border-bottom: 2px solid #3498db;
            padding-bottom: 6px;
            color: #2c3e50;
        }

        .ticket td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            color: #333;
        }

        .ticket .total {
            text-align: right;
            font-size: 20px;
            margin-top: 15px;
            color: #27ae60;
            font-weight: bold;
        }

        .ticket .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }

        .ticket .actions {
            text-align: center;
            margin-top: 30px;
        }

        .ticket .actions a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
            transition: 0.3s ease;
        }

        .ticket .actions a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h2><i class="fa fa-ticket"></i> Orden de Compra</h2>
        <div class="folio">Folio: <strong><?php echo $folio; ?></strong></div>

        <table>
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cant.</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $item):
                    $subtotal = $item['precio'] * $item['cantidad']; ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td>$<?php echo number_format($item['precio'], 2); ?></td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">Total: $<?php echo number_format($total, 2); ?></div>

        <div class="footer">
            ¡Gracias por tu compra!<br>
            <?php echo date('d/m/Y H:i:s'); ?>
        </div>

        <div class="actions">
            <a href="mis_ordenes.php"><i class="fa fa-list-alt"></i> Ver mis órdenes</a>
            <a href="index.php"><i class="fa fa-home"></i> Volver al inicio</a>
        </div>
    </div>
</body>
</html>
