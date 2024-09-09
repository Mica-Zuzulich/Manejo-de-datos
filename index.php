<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sistema web universitario</title>
</head>
<body>
    <h1>Informacion de las materias</h1>
    <form action="PHP/form.php" method="post">
        <label for="materia">Nombre de la materias:</label>
        <input type="text" id="materia" name="materia" required><br><br>

        <label for="profesor">Nombre del profesor:</label>
        <input type="text" id="profesor" name="profesor" required><br><br> 
        
        <label for="carrera_id">Carrera:</label>
        <select id="carrera_id" name="carrera_id" required>
        <?php
            include "PHP/selec.php";
            ?>
        </select>


        <input type="submit" value="Agregar Materia">
    </form>


    <h2>Materias Existentes</h2>

    <?php
    require 'PHP/db.php'; 

    $sql_select = "SELECT * FROM web";
    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->execute();
    $materias = $stmt_select->fetchAll(PDO::FETCH_ASSOC);

    if (count($materias) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Materia</th>
                    <th>Profesor</th>
                    <th>Acciones</th>
                </tr>";
        foreach ($materias as $materia) {
            echo "<tr>
                    <td>{$materia['materia']}</td>
                    <td>{$materia['profesor']}</td>
                    <td>
                        <a href='PHP/editar.php?ID={$materia['ID']}'>Editar</a>
                        <a href='PHP/delete.php?ID={$materia['ID']}'>Eliminar</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay materias registradas.</p>";
    }
    ?>
    <h2>Listar Materias por Carrera</h2>
    <form action="PHP/listar_materias.php" method="post">
        <label for="carrera_id">Selecciona una carrera:</label>
        <select id="carrera_id" name="carrera_id" required>
        <?php include "PHP/selec.php"; ?>
        </select>
        <input type="submit" value="Listar Materias">
    </form>

    <h2>Carreras con Duración Menor a 3 Años</h2>
    <a href="PHP/filtrar_carrera.php">Ver Carreras</a>
</body>
</html>