<?php
require "db.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['carrera_id'])){
        $carrera_id=$_POST['carrera_id'];

        $sql_select="SELECT *FROM web WHERE carrera_id = :carrera_id";
        $stmt_select=$pdo->prepare($sql_select);
        $stmt_select->bindValue(':carrera_id', $carrera_id, PDO::PARAM_INT);
        $stmt_select->execute();
        $materias = $stmt_select->fetchAll(PDO::FETCH_ASSOC);


        if (count($materias) > 0) {
            echo "<h2>Materias de la Carrera Seleccionada</h2>";
            echo "<table border='1'>
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
            echo "<p>No hay materias registradas para esta carrera.</p>";
        }
    } else {
        echo "Por favor seleccione una carrera.";
    }
}else {
    header("Location: ../index.php");
    exit();
}
?>