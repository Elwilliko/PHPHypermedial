<?php
session_start();

include '../../config/PHP.php';

$usuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
$contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;

$sql = "SELECT * FROM usuario WHERE usu_correo = '$usuario' and usu_password = MD5('$contrasena')";
$sql1 = "SELECT usu_correo, usu_password FROM usuario";

$result = $conn->query($sql);
$result1 = $conn->query($sql1);

if ($result->num_rows > 0) {
    $_SESSION['isLogged'] = TRUE;
    echo("Location: ../../admin/vista/usuario/index.php");
} else {
    echo("Location: ../vista/login.html");
    if ($result1->num_rows > 0) {
        // output data of each row
        while($row = $result1->fetch_assoc()) {
            echo "<br> Correo: ". $row["usu_correo"]. " - Contrasena: ". $row["usu_password"] . "<br>";
        }
    }
}

$conn->close();

?>