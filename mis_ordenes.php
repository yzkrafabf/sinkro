<?php
session_start();
include 'db.php';

$userId = $_SESSION['id'] ?? null;
if (!$userId) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM ordenes WHERE usuario_id = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Órdenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f4f4f4;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .ordenes-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .orden-card {
        border: 1px solid #dcdcdc;
        border-left: 5px solid #3498db;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        background-color: #fafafa;
    }

    .orden-card h5 {
        margin: 0;
        color: #2c3e50;
    }

    .orden-card small {
        color: #888;
    }

    .orden-card .total {
        color: #27ae60;
        font-weight: bold;
    }

    .orden-card .btn {
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="ordenes-container">
        <h2 class="mb-4 text-center">Mis Órdenes de Compra</h2>

        <?php if ($result->num_rows > 0): ?>
        <?php while ($orden = $result->fetch_assoc()): ?>
        <div class="orden-card">
            <h5>Folio: <?php echo $orden['folio']; ?></h5>
            <small>Fecha: <?php echo date('d/m/Y H:i', strtotime($orden['fecha'])); ?></small><br>
            <span class="total">Total: $<?php echo number_format($orden['total'], 2); ?></span><br>
            <a href="ver_orden.php?folio=<?php echo $orden['folio']; ?>" class="btn btn-primary btn-sm">Ver ticket</a>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <p class="text-center text-muted">No has realizado ninguna compra todavía.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-secondary">Volver al inicio</a>
        </div>
    </div>
</body>

</html>