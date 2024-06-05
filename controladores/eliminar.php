<?php
// Paso 1: importar la libreria
require "../Confi/conex.php";

// Paso 2: Verificar si se ha enviado el documento
if(isset($_POST["codigo"])) {
    // Almacenar las variables
    $cod = $_POST["codigo"];
  
    try {
        // Paso 3: armar el SQL en una variable
        $sql_eliminar = "DELETE FROM `datos` WHERE cod = :codigo";

        // Preparar la consulta
        $stmt = $dbh->prepare($sql_eliminar);
        
        // Vincular el parámetro
        $stmt->bindParam(':codigo', $cod, PDO::PARAM_INT);

        // Paso 4: enviar a la BD
        if($stmt->execute()) {
            echo "Registro eliminado correctamente";
        } else {
            echo "Error al eliminar el registro: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: No se ha recibido el documento.";
}
?>


