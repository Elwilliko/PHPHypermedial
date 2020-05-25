<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Usuario</title>
    <style type="text/css" rel="stylesheet">
        .error{
            color: red;
        }
    </style>
</head>
<body>
<?php
//incluir conexión a la base de datos
include '../../config/PHP.php';
$cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
$nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null;
$apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;
$roles = isset($_POST["roles"]) ? mb_strtoupper(trim($_POST["roles"]), 'UTF-8') : null;
$correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
$contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;
$numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : null;
$tipo = isset($_POST["tipo"]) ? mb_strtoupper(trim($_POST["tipo"]), 'UTF-8') : null;
$operadora = isset($_POST["operadora"]) ? mb_strtoupper(trim($_POST["operadora"]), 'UTF-8') : null;

$maxval = $conn->query("SELECT usu_codigo FROM usuario WHERE usu_codigo=(SELECT max(usu_codigo) FROM usuario)");

while ($row = $maxval->fetch_assoc()) {
    $usu_tel_codigo = $row['usu_codigo'];

}
$usu_tel_codigo+=1;
echo($usu_tel_codigo);


$sql = "INSERT INTO usuario VALUES (0, '$cedula', '$nombres', '$apellidos', '$roles', '$correo', MD5('$contrasena'))";
$sql1 = "INSERT INTO Telefono VALUES (0,'$numero','$tipo','$operadora','$usu_tel_codigo')";

if ($conn->query($sql) === TRUE) {
    echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
} else {
    if($conn->errno == 1062){
        echo "<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema </p>";
    }else{
        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
}

//cerrar la base de datos
$conn->close();
echo "<a href='../vista/crear_usuario.html'>Regresar</a>";

?>
</body>
</html>
