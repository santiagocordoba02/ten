<?php
// Paso 1: importar la librería
require "../Confi/conex.php";

// Definir el valor mínimo requerido para el precio
$precio_minimo = 9.200;

$precio = $_POST["precio"];
if ($precio >= $precio_minimo) {
    echo "carne hecha";
} else {
    echo "no cumples el valor ";
}

// Paso 2: Verificar si se han enviado todos los datos esperados
if (isset($_POST["kilos"], $_POST["tipo"], $_POST["precio"])) {
    // Almacenar las variables
    $fecha_sys = date('Y-m-d H:i:s');
    $kilos = $_POST["kilos"];
    $tipo = $_POST["tipo"];
    $precio = $_POST["precio"];

    // Paso 3: armar el SQL en una variable usando prepared statements para prevenir SQL injection
    $sql_insertar = "INSERT INTO datos (fecha_sys, kilos, tipo, precio) VALUES (:fecha_sys, :kilos, :tipo, :precio)";

    // Paso 4: enviar a la BD usando prepared statements
    $stmt = $dbh->prepare($sql_insertar);
    $stmt->bindParam(':fecha_sys', $fecha_sys);
    $stmt->bindParam(':kilos', $kilos);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':precio', $precio);

    // Ejecutar la declaración preparada
    if ($stmt->execute()) {
        echo "Información registrada correctamente";
    } else {
        echo "Error al registrar la información: " . $stmt->errorInfo()[2]; 
    }
} else {
    echo "Error: No se han recibido todos los datos esperados.";
}
?>
