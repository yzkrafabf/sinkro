<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container mt-5">
        <h1>Tu carrito</h1>
        <?php if (empty($carrito)): ?>
        <p>No has agregado productos aún.</p>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    foreach ($carrito as $item):
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                    ?>
                <tr id="fila-<?php echo $item['id']; ?>">
                    <td><img src="img/<?php echo $item['imagen']; ?>" width="50"></td>
                    <td><?php echo $item['nombre']; ?></td>
                    <td>$<?php echo $item['precio']; ?></td>
                    <!-- Dentro del <td> de cantidad -->
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-outline-secondary btn-sm"
                                onclick="actualizarCantidad(<?php echo $item['id']; ?>, 'disminuir')">−</button>
                            <span><?php echo $item['cantidad']; ?></span>
                            <button class="btn btn-outline-secondary btn-sm"
                                onclick="actualizarCantidad(<?php echo $item['id']; ?>, 'incrementar')">+</button>
                        </div>
                    </td>

                    <td>$<?php echo $subtotal; ?></td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="eliminarProducto(<?php echo $item['id']; ?>)"><i
                                class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td><strong>$<?php echo $total; ?></strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <button class="btn btn-warning" onclick="vaciarCarrito()">Vaciar Carrito</button>
        <?php endif; ?>
        <button class="btn btn-success ms-2" onclick="finalizarCompra()">Finalizar Compra</button>

    </div>

    <script>
    function eliminarProducto(id) {
        if (confirm('¿Eliminar este producto del carrito?')) {
            fetch('eliminar_del_carrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + id
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'ok') {
                        document.getElementById('fila-' + id).remove();
                        alert(data.mensaje);
                        location.reload(); // Refresca total si deseas mantenerlo actualizado
                    } else {
                        alert(data.mensaje);
                    }
                });
        }
    }

    function vaciarCarrito() {
        if (confirm('¿Vaciar todo el carrito?')) {
            fetch('vaciar_carrito.php')
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'ok') {
                        alert(data.mensaje);
                        location.reload();
                    } else {
                        alert('Error al vaciar el carrito');
                    }
                });
        }
    }

    function actualizarCantidad(id, accion) {
        fetch('actualizar_cantidad.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id + '&accion=' + accion
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'ok') {
                    location.reload();
                } else {
                    alert(data.mensaje);
                }
            });
    }

    function finalizarCompra() {
        window.location.href = 'finalizar_compra.php';
    }
    </script>
</body>

</html>