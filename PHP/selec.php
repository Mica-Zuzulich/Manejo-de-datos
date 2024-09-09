<?php
require 'db.php'; 

$sql_carrera = "SELECT ID, nombre FROM carrera";
$resultado = $pdo->query($sql_carrera);

if ($resultado === false) {
    die("Error en la consulta: " . $pdo->errorInfo()[2]);
}

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . htmlspecialchars($row["ID"]) . '">' . htmlspecialchars($row["nombre"]) . '</option>';
}
?>
