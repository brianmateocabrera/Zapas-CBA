<?php
$host = 'sql313.infinityfree.com';
$username = 'if0_38710492';
$password = 'zapatillaskesug';
$dbname = 'if0_38710492_catalogo';

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres para evitar problemas con caracteres especiales
$conn->set_charset("utf8");

?>