<?php
session_start();
include 'db.php';

$productos = $conn->query("SELECT * FROM productos");
?>

<!doctype html>
<html lang="en">

<!-- NOTA: AQUI VA EL HEADER -->



<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="css/estilo.css">
  <!-- <link rel="stylesheet" href="css/login.css"> -->

  <link rel="stylesheet" href="css/bootstrap.min.css">

  <title>Tienda de Snacks</title>


</head>


<body>
  <div class="">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">
          <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">Tienda de Snacks y Bebidas</font>
          </font>
        </span>
      </a>

      <ul class="nav nav-pills align-items-center">
        <?php if (isset($_SESSION['id'])): ?>
          <li class="nav-item me-3">
            <span class="nav-link disabled">Hola, <?php echo $_SESSION['nombre']; ?></span>
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
          <div class="col-lg-12 d-flex flex-wrap">
            <?php while ($row = $productos->fetch_assoc()): ?>

              <div class="card producto shadow p-3 mb-5 bg-body rounded m-3" style="width: 18rem;">
                <img src="img/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>">
                <h2><?php echo $row['nombre']; ?></h2>
                <p>$<?php echo $row['precio']; ?></p>
                <button class="btn btn-success"
                  onclick="agregarAlCarrito(<?php echo $row['id']; ?>)">Agregar</button>
              </div>

              <!-- <div class="producto">
        <img src="img/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>">
        <h2><?php echo $row['nombre']; ?></h2>
        <p>$<?php echo $row['precio']; ?></p>
        <button onclick="agregarAlCarrito(<?php echo $row['id']; ?>)">Agregar</button>
      </div> -->
            <?php endwhile; ?>

          </div>
        </div>
      </div>

    </section>
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