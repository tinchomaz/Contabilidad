<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contafinal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario y realizar la inserción en la base de datos
    $nroCuenta = $_POST['nroCuenta'];
    $rubro = $_POST['rubro'];
    $descripcion = $_POST['descripcion'];

    // Verificar que el número de cuenta sea mayor a 1
    if ($nroCuenta < 1) {
        echo 'invalid';
        exit;
    }

    // Verificar que el número de cuenta no esté duplicado
    $duplicateCheck = "SELECT COUNT(*) as count FROM plancuentas WHERE nroCuenta = '$nroCuenta'";
    $duplicateResult = $conn->query($duplicateCheck);

    if ($duplicateResult && $duplicateResult->fetch_assoc()['count'] > 0) {
        echo 'duplicate';
        exit;
    }

    $sql = "INSERT INTO plancuentas (nroCuenta, rubro, descripcion) VALUES ('$nroCuenta', '$rubro', '$descripcion')";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }
}

$sql = "SELECT * FROM plancuentas ORDER BY CAST(nroCuenta AS SIGNED) ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Error al ejecutar la consulta: " . $conn->error);
}

$activoRows = $pasivoRows = $patrimonioRows = '';

while ($row = $result->fetch_assoc()) {
    $nroCuenta = $row['nroCuenta'];
    $rubro = $row['rubro'];
    $descripcion = $row['descripcion'];
    switch ($rubro) {
        case 'A':
            $rubro = 'ACTIVO';
            break;
        case 'P':
            $rubro = 'PASIVO';
            break;
        case 'N':
            $rubro = 'PATRIMONIO NETO';
            break;
    }
    // Dependiendo del rubro, asignar la fila a la sección correspondiente
    switch ($rubro) {
        case 'ACTIVO':
            $activoRows .= "<tr><td>$nroCuenta</td><td>$rubro</td><td>$descripcion</td></tr>";
            break;
        case 'PASIVO':
            $pasivoRows .= "<tr><td>$nroCuenta</td><td>$rubro</td><td>$descripcion</td></tr>";
            break;
        case 'PATRIMONIO NETO':
            $patrimonioRows .= "<tr><td>$nroCuenta</td><td>$rubro</td><td>$descripcion</td></tr>";
            break;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLAN DE CUENTAS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        button {
            padding: 10px;
            margin: 15px 0;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            display: block;
            width: 200px;
            margin: 15px auto;
        }

        button:hover {
            background-color: #0056b3;
        }

        .addButton {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 8px;
            margin-left: 10px;
        }

        .addButton:hover {
            background-color: #218838;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>PLAN DE CUENTAS</h1>

<button onclick="toggleTable('activo')">Activo</button>
<div id="activoTable" style="display: none;">
    <button class="addButton" onclick="addRow('activo')">+</button>
    <table>
        <thead>
        <tr>
            <th>Nro. Cuenta</th>
            <th>Rubro</th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        <?php echo $activoRows; ?>
        </tbody>
    </table>
</div>

<button onclick="toggleTable('pasivo')">Pasivo</button>
<div id="pasivoTable" style="display: none;">
    <button class="addButton" onclick="addRow('pasivo')">+</button>
    <table>
        <thead>
        <tr>
            <th>Nro. Cuenta</th>
            <th>Rubro</th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        <?php echo $pasivoRows; ?>
        </tbody>
    </table>
</div>

<button onclick="toggleTable('patrimonio')">Patrimonio Neto</button>
<div id="patrimonioTable" style="display: none;">
    <button class="addButton" onclick="addRow('patrimonio')">+</button>
    <table>
        <thead>
        <tr>
            <th>Nro. Cuenta</th>
            <th>Rubro</th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        <?php echo $patrimonioRows; ?>
        </tbody>
    </table>
</div>

<script>
    function toggleTable(section) {
        var table = document.getElementById(section + 'Table');
        table.style.display = table.style.display === 'none' ? 'block' : 'none';
    }

    function addRow(section) {
        var table = document.querySelector('#' + section + 'Table tbody');
        var newRow = table.insertRow(table.rows.length);

        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);

        // Crear un input text para cell1
        var inputText1 = document.createElement('input');
        inputText1.type = 'number';
        cell1.appendChild(inputText1);

        // Agregar celda de texto según la sección
        var inputTextRubro = document.createElement('input');
        inputTextRubro.type = 'text';
        inputTextRubro.value = section.toUpperCase(); // Valor predeterminado según la sección
        inputTextRubro.readOnly = true; // Hacer el campo de solo lectura
        cell2.appendChild(inputTextRubro);

        // Crear un input text para cell3
        var inputText2 = document.createElement('input');
        inputText2.type = 'text';
        cell3.appendChild(inputText2);
        // Agregar evento para capturar la tecla "Enter"
        inputText2.addEventListener('keyup', function (event) {
            if (event.key === 'Enter') {
                // Aquí puedes realizar la acción de guardar y mostrar la fila
                saveAndShowRow(section, newRow);
            }
        });
    }

    function saveAndShowRow(section, newRow) {
        var inputs = newRow.querySelectorAll('input');
        var nroCuenta = inputs[0].value;
        var rubro = section.toUpperCase();
        var descripcion = inputs[2].value;

        // Enviar datos al servidor mediante AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText.trim();
                if (response === 'duplicate') {
                    alert("Ya existe un registro con el mismo número de cuenta.");
                } else if (response === 'invalid') {
                    alert("El número de cuenta debe ser mayor a 1.");
                } else {
                    // No hay duplicados ni números de cuenta inválidos, proceder con la inserción
                    newRow.cells[0].textContent = nroCuenta;
                    newRow.cells[1].textContent = rubro;
                    newRow.cells[2].textContent = descripcion;
                    inputs[0].disabled = true;
                    inputs[2].disabled = true;
                    inputs[0].style.display = 'none';
                    inputs[2].style.display = 'none';
                }
            }
        };

        // Cambiar la solicitud a POST y enviar datos en formato FormData
        xhttp.open("POST", "", true);
        var formData = new FormData();
        formData.append('nroCuenta', nroCuenta);
        formData.append('rubro', rubro);
        formData.append('descripcion', descripcion);
        xhttp.send(formData);
    }
</script>

</body>
</html>
