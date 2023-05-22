<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:proyecto-final.database.windows.net,1433; Database = angencia-empelo-bogota", "adminproject", "{Proyecto_datos}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "adminproject", "pwd" => "{Proyecto_datos}", "Database" => "angencia-empelo-bogota", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:proyecto-final.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);


/* Obtener los valores enviados por el formulario de registro */
$nombreEmpresa = $_POST['nombre_empresa'];
$email = $_POST['correo'];
$contrasena = $_POST['clave'];
$nit = $_POST['nit'];
$razonSocial = $_POST['razon-social'];
$representanteLegal = $_POST['representante'];
$telefono = $_POST['phone'];
$direccion = $_POST['direccion'];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
$sedePrincipal = $_POST['sede'];

/* Preparar la consulta sql */
$sql = "INSERT INTO Empresas (nombreEmpresa, email, contrasena, nit, razonSocial, representanteLegal, telefono, direccion, pais, ciudad, sedePrincipal)
        VALUES (:nombre, :email, :contrasena, :nit, :razon_social, :representante_legal, :telefono, :direccion, :pais, :ciudad, :sede_principal)");

$stmt = $conn->prepare($sql);

$stmt->bindParam(':nombre', $nombreEmpresa);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':contrasena', $contrasena);
$stmt->bindParam(':nit', $nit);
$stmt->bindParam(':razon_social', $razonSocial);
$stmt->bindParam(':representante_legal', $representanteLegal);
$stmt->bindParam(':telefono', $telefono);
$stmt->bindParam(':direccion', $direccion);
$stmt->bindParam(':pais', $pais);
$stmt->bindParam(':ciudad', $ciudad);
$stmt->bindParam(':sede_principal', $sedePrincipal);
$stmt->execute();

// Verificar si la inserción fue exitosa
if ($stmt->rowCount() > 0) {
    // La inserción se realizó correctamente
    echo "Los datos se han insertado correctamente en la base de datos.";
} else {
    // Ocurrió un error durante la inserción
    echo "Error al insertar los datos en la base de datos.";
}

?>
