<?php
$password = "123"; // la contraseña que tú quieras
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Contraseña original: $password<br>";
echo "Hash generado: $hash";
