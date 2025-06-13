<?php
session_start();
include 'db.php';

$userId = $_SESSION['id'] ?? null;
$folio = $_GET['folio'] ?? '';

$query = "SELECT * FROM ordenes WHERE folio = ? AND usuario_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $folio, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Orden no encontrada.";
    exit();
}

$orden = $result->fetch_assoc();

$queryItems = "SELECT * FROM orden_items WHERE orden_id = ?";
$stmtItems = $conn->prepare($queryItems);
$stmtItems->bind_param("i", $orden['id']);
$stmtItems->execute();
$items = $stmtItems->get_result();
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Orden <?php echo $folio; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .orden-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .orden-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .orden-header h2 {
            margin-bottom: 10px;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .orden-total {
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 15px;
        }

        .orden-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #666;
        }

        .btn-back {
            display: block;
            margin: 30px auto 0;
        }
    </style>
</head>

<body>
    <div class="orden-container">
        <div class="orden-header">
            <h2>Orden de Compra</h2>
            <div class="text-muted">Folio: <strong><?php echo $folio; ?></strong></div>
        </div>

        <div class="d-flex justify-content-center">
            <table class="table table-bordered table-striped w-100">
                <thead class="table-light">
                    <tr>
                        <th style="min-width: 40%;">Artículo</th>
                        <th style="min-width: 10%; text-align: center;">Cant.</th>
                        <th style="min-width: 20%; text-align: right;">Precio</th>
                        <th style="min-width: 20%; text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = $items->fetch_assoc()):
                        $subtotal = $item['precio'] * $item['cantidad']; ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                            <td style="text-align: center;"><?php echo $item['cantidad']; ?></td>
                            <td style="text-align: right;">$<?php echo number_format($item['precio'], 2); ?></td>
                            <td style="text-align: right;">$<?php echo number_format($subtotal, 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="orden-total">
            Total: $<?php echo number_format($orden['total'], 2); ?>
        </div>

        <div class="orden-footer">
            Fecha de compra: <?php echo date('d/m/Y H:i:s', strtotime($orden['fecha'])); ?><br>
            Gracias por tu compra.
        </div>

        <a href="mis_ordenes.php" class="btn btn-outline-secondary btn-sm btn-back">← Volver a mis órdenes</a>
    </div>
</body>

</html>
        <a href="mis_ordenes.php" class="btn btn-outline-secondary btn-sm btn-back">← Volver a mis órdenes</a>
    </div>
</body>

</html>
