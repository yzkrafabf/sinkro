<?php include 'db.php'; $productos = $conn->query("SELECT * FROM productos"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda de Snacks</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <header><h1>Tienda de Snacks y Bebidas</h1></header>
  <main class="productos">
    <?php while($row = $productos->fetch_assoc()): ?>
      <div class="producto">
        <img src="img/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>">
        <h2><?php echo $row['nombre']; ?></h2>
        <p>$<?php echo $row['precio']; ?></p>
        <button onclick="agregarAlCarrito(<?php echo $row['id']; ?>)">Agregar</button>
      </div>
    <?php endwhile; ?>
  </main>
  <a href="carrito.php" class="ver-carrito">Ver Carrito</a>
  <script src="js/carrito.js"></script>
</body>
</html>
