<?php

require "../config/conex.php";


$now = $_POST["now"]

$sql = "SELECT cod, documento, nombre, tipo_carrera, celular, fecha_sys FROM vender WHERE nombre like ".%now%.""
print "<table border ='4'>"
<tr>
<td>codigo</td>
<td>documento</td>
<td>nombre</td>
<td>tipo_carrera</td>
<td>celular</td>
<td>fecha</td>
</tr>

foreach($dbh->query($sql) as $row)
{
    $cod =$row[0];
    $documento =$row[1];
    $nombre =$row[2];
    $tipo_carrera =$row[3];
    $celular =$row[4];
    $fecha =$row[5];


print =
<tr>
<td>.$cod.</td>
<td>.$documento.</td>
<td>.$ nombre.</td>
<td>.$ tipo_carrera.</td>
<td>.$celular.</td>
<td>.$fecha_sys.</td>
</tr>;

}

print "</table>"
?>