<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <header><h1>Carrito de Compras</h1></header>
  <main>
    <div id="carrito"></div>
    <form action="procesar_pedido.php" method="POST" onsubmit="return guardarPedido(this)">
      <input type="text" name="nombre" placeholder="Tu nombre" required>
      <input type="tel" name="telefono" placeholder="Teléfono" required>
      <input type="hidden" name="pedido" id="pedido-json">
      <button type="submit">Generar Pedido</button>
    </form>
  </main>
  <script src="js/carrito.js"></script>
</body>
</html>
