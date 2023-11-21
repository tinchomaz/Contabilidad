<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contafinal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "ok";
}

$fecha = $_POST['fecha'];
$contadorCuentasDebe = $_POST['contadorCuentasDebe'];
$contadorCuentasHaber = $_POST['contadorCuentasHaber'];

for ($i = 1; $i <= $contadorCuentasDebe; $i++) {
    $cuentaDebe = $_POST['cuentaDebe' . $i];
    $saldoDebe = $_POST['saldoDebe' . $i];

    // Verifica si la cuenta existe en plancuentas antes de insertar en diario
    $verificarCuenta = "SELECT COUNT(*) as cuenta_existente FROM plancuentas WHERE nroCuenta = '$cuentaDebe'";
    $resultado = $conn->query($verificarCuenta);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        if ($fila['cuenta_existente'] > 0) {
            // La cuenta existe, puedes realizar la inserción en diario
            $sql = "INSERT INTO diario (fecha, nroCuenta, debe, haber) VALUES ('$fecha', '$cuentaDebe', '$saldoDebe', 0)";
            $conn->query($sql);
        } else {
            die("Error: La cuenta $cuentaDebe no existe en la tabla plancuentas.");
        }
    }
}

for ($i = 1; $i <= $contadorCuentasHaber; $i++) {
    $cuentaHaber = $_POST['cuentaHaber' . $i];
    $saldoHaber = $_POST['saldoHaber' . $i];

    // Verifica si la cuenta existe en plancuentas antes de insertar en diario
    $verificarCuenta = "SELECT COUNT(*) as cuenta_existente FROM plancuentas WHERE nroCuenta = '$cuentaHaber'";
    $resultado = $conn->query($verificarCuenta);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        if ($fila['cuenta_existente'] > 0) {
            // La cuenta existe, puedes realizar la inserción en diario
            $sql = "INSERT INTO diario (fecha, nroCuenta, debe, haber) VALUES ('$fecha', '$cuentaHaber', 0, '$saldoHaber')";
            $conn->query($sql);
        } else {
            die("Error: La cuenta $cuentaHaber no existe en la tabla plancuentas.");
        }
    }
}

$conn->close();

header("Location: diario.php");
exit();
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contafinal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "ok";
}

$fecha = $_POST['fecha'];
$contadorCuentasDebe = $_POST['contadorCuentasDebe'];
$contadorCuentasHaber = $_POST['contadorCuentasHaber'];

for ($i = 1; $i <= $contadorCuentasDebe; $i++) {
    $cuentaDebe = $_POST['cuentaDebe' . $i];
    $saldoDebe = $_POST['saldoDebe' . $i];

    // Verifica si la cuenta existe en plancuentas antes de insertar en diario
    $verificarCuenta = "SELECT COUNT(*) as cuenta_existente FROM plancuentas WHERE nroCuenta = '$cuentaDebe'";
    $resultado = $conn->query($verificarCuenta);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        if ($fila['cuenta_existente'] > 0) {
            // La cuenta existe, puedes realizar la inserción en diario
            $sql = "INSERT INTO diario (fecha, nroCuenta, debe, haber) VALUES ('$fecha', '$cuentaDebe', '$saldoDebe', 0)";
            $conn->query($sql);
        } else {
            die("Error: La cuenta $cuentaDebe no existe en la tabla plancuentas.");
        }
    }
}

for ($i = 1; $i <= $contadorCuentasHaber; $i++) {
    $cuentaHaber = $_POST['cuentaHaber' . $i];
    $saldoHaber = $_POST['saldoHaber' . $i];

    // Verifica si la cuenta existe en plancuentas antes de insertar en diario
    $verificarCuenta = "SELECT COUNT(*) as cuenta_existente FROM plancuentas WHERE nroCuenta = '$cuentaHaber'";
    $resultado = $conn->query($verificarCuenta);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        if ($fila['cuenta_existente'] > 0) {
            // La cuenta existe, puedes realizar la inserción en diario
            $sql = "INSERT INTO diario (fecha, nroCuenta, debe, haber) VALUES ('$fecha', '$cuentaHaber', 0, '$saldoHaber')";
            $conn->query($sql);
        } else {
            die("Error: La cuenta $cuentaHaber no existe en la tabla plancuentas.");
        }
    }
}

$conn->close();

header("Location: diario.php");
exit();