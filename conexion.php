<?php 
$host = 'localhost';
$dbname = 'contacto';
$username = 'root';
$password1 = 'root';

$conexion = mysqli_connect($host, $username, $password1, $dbname);
if(!$conexion) {
    die("Error de conexion" .mysqli_connect_error());
}
?>