<?php

//Importar la conexión
require 'includes/config/database.php';
$db = conectarDB();
$db->set_charset('utf8');

//Crear un email y password
$email = "correo2@correo.com";
$password ="123456";

// Hashear el password
$passwordHash = password_hash($password, PASSWORD_DEFAULT); //PASSWORD_BCRYPT (60 caracteres);

//Query
$query = "INSERT INTO usuarios(email, password) VALUES ('${email}', '${passwordHash}')";

exit;
//Agregarlo a la base de datos
mysqli_query($db, $query);
?>