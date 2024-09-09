<?php
require "db.php";

$sql_carreras = "SELECT ID FROM carrera WHERE duracion < 3";// solo las que son menores de 3 años
$stmt_carreras = $pdo->prepare($sql_carreras);
$stmt_carreras->execute();
$carreras = $stmt_carreras->fetchAll(PDO::FETCH_COLUMN);

if (count($carreras) > 0) {
    $placeholders = str_repeat('?,', count($carreras) - 1) . '?';
    $sql_materias = "SELECT * FROM web WHERE carrera_id IN ($placeholders)";
    $stmt_materias = $pdo->prepare($sql_materias);
    $stmt_materias->execute($carreras);
    $materias = $stmt_materias->fetchAll(PDO::FETCH_ASSOC);

    if (count($materias) > 0) {
        echo "<h2>Materias de Carreras Menor a 3 Años</h2>";
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Materia</th>
                    <th>Profesor</th>
                </tr>";
        foreach ($materias as $materia) {
            echo "<tr>
                    <td>{$materia['ID']}</td>
                    <td>{$materia['materia']}</td>
                    <td>{$materia['profesor']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay materias menor a 3 años.</p>";
    }
} else {
    echo "<p>No hay carreras con una duración menor a 3 años.</p>";
}
?>