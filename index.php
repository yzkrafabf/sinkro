<?php
session_start();
include 'db.php';

$productos = $conn->query("SELECT * FROM productos");
?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Fonts Quicksand -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Tienda de Snacks</title>
</head>

<body>
  <div>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Tienda de Snacks y Bebidas</span>
      </a>
      <ul class="nav nav-pills align-items-center">
        <?php if (isset($_SESSION['id'])): ?>
          <li class="nav-item me-3">
            <span class="nav-link disabled">Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link text-danger">Cerrar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mis_ordenes.php">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Mis Órdenes
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a href="login.php" class="nav-link">Iniciar sesión</a>
          </li>
        <?php endif; ?>
      </ul>
    </header>
  </div>
  <main>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 d-flex flex-wrap justify-content-center">
            <?php while ($row = $productos->fetch_assoc()): ?>
              <div class="card producto shadow p-3 mb-5 bg-body rounded m-3">
                <img 
                  src="img/<?php echo htmlspecialchars($row['imagen']); ?>" 
                  alt="<?php echo htmlspecialchars($row['nombre']); ?>" 
                  class="card-img-top">
                <div class="card-body text-center">
                  <h2 class="card-title"><?php echo htmlspecialchars($row['nombre']); ?></h2>
                  <p class="card-text">$<?php echo htmlspecialchars($row['precio']); ?></p>
                  <button class="btn btn-success"
                    onclick="agregarAlCarrito(<?php echo $row['id']; ?>)">Agregar</button>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Redes Sociales al final de la página -->
    <footer class="social-footer">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h3 class="social-title">¡Síguenos en nuestras redes sociales!</h3>
            <div class="social-media-links-footer">
              <a href="https://www.facebook.com/share/1AxW1s8x6V/" target="_blank" class="social-link-footer facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://www.instagram.com/zinkroshop" target="_blank" class="social-link-footer instagram">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <div class="position-absolute bottom-0 end-0">
      <a class="ver-carrito btn btn-primary" href="carrito.php" target="_blank">Ver Carrito</a>
    </div>
  </main>

  <script src="js/carrito.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.4/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>
</html>
