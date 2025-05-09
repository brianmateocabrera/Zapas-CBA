<?php
// ----------------------------
// CONFIGURACIÓN GLOBAL
// ----------------------------

// Mostrar errores (solo durante desarrollo, desactivá en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ----------------------------
// CONEXIÓN A LA BASE DE DATOS
// ----------------------------
$host = 'sql313.infinityfree.com';
$username = 'if0_38710492';
$password = 'zapatillaskesug';
$dbname = 'if0_38710492_catalogo';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    error_log("Fallo de conexión: " . $conn->connect_error, 3, 'log_errores.txt');
    header("Location: errores.php?error=500");
    exit();
}

// ----------------------------
// MANEJO DE ERRORES PHP
// ----------------------------

// Captura errores de ejecución
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    error_log("Error [$errno] $errstr en $errfile línea $errline" . PHP_EOL, 3, 'log_errores.txt');
    header("Location: errores.php?error=500");
    exit();
});

// Captura excepciones no controladas
set_exception_handler(function($exception) {
    error_log("Excepción: " . $exception->getMessage() . PHP_EOL, 3, 'log_errores.txt');
    header("Location: errores.php?error=500");
    exit();
});
?>