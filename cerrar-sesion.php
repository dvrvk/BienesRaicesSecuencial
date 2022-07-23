<?php 
//Iniciar la sesión
session_start();

//Cierro sesión
$_SESSION = [];

//Redirigir
header('location: /');