<?php
// Paso 1: importar la librería
require "../Confi/conex.php";

// Verificar la conexión a la base de datos
if (!isset($dbh)) {
    die("Error en la conexión a la base de datos.");
}

// Paso 2: Verificar si se han enviado todos los datos esperados
if (isset($_POST["codigo"]) && isset($_POST["kilos"]) && isset($_POST["tipo"])) {
    $codigo = $_POST["codigo"];
    $kilos = $_POST["kilos"];
    $tipo = $_POST["tipo"];
    $fecha_sys = date('Y-m-d H:i:s');

    // Paso 3: Verificar si el nuevo código ya existe
    $sql_verificar = "SELECT COUNT(*) FROM datos WHERE cod = :codigo";
    $stmt_verificar = $dbh->prepare($sql_verificar);
    $stmt_verificar->bindParam(':codigo', $codigo);
    $stmt_verificar->execute();
    $count = $stmt_verificar->fetchColumn();

    if ($count > 0) {
        echo "Error: El código ya existe.";
    } else {
        // Paso 4: Crear la consulta SQL de actualización
        $sql_actualizar = "UPDATE datos SET cod = :codigo WHERE kilos = :kilos AND tipo = :tipo";

        // Paso 5: preparar la consulta para evitar inyecciones SQL
        $stmt = $dbh->prepare($sql_actualizar);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':kilos', $kilos);
        $stmt->bindParam(':tipo', $tipo);

        // Paso 6: ejecutar la consulta
        try {
            if ($stmt->execute()) {
                echo "Información actualizada correctamente";
            } else {
                echo "Error al actualizar la información: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
} else {
    echo "Error: No se han recibido todos los datos esperados.";
}
?>
