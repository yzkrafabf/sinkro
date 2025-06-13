function agregarAlCarrito(idProducto) {
  fetch("agregar_carrito.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "id=" + idProducto,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "ok") {
        alert("Producto agregado al carrito");
      } else {
        alert("Error: " + data.mensaje);
      }
    })
    .catch((error) => {
      console.error("Error en AJAX:", error);
      alert("Ocurrió un error al agregar el producto");
    });
}
