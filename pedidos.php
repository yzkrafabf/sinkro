<?php include 'db.php'; $pedidos = $conn->query("SELECT * FROM pedidos ORDER BY fecha DESC"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedidos</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <header><h1>Pedidos Generados</h1></header>
  <main>
    <table>
      <tr><th>Folio</th><th>Cliente</th><th>Teléfono</th><th>Total</th><th>Fecha</th></tr>
      <?php while($p = $pedidos->fetch_assoc()): ?>
        <tr>
          <td><?php echo $p['folio']; ?></td>
          <td><?php echo $p['nombre_cliente']; ?></td>
          <td><?php echo $p['telefono']; ?></td>
          <td>$<?php echo $p['total']; ?></td>
          <td><?php echo $p['fecha']; ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </main>
</body>
</html>
