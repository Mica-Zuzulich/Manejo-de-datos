<?php
require 'db.php';

$materia = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['materia']) && !empty($_POST['profesor']) && !empty($_POST['ID'])) {
        $id = $_POST['ID'];
        $materia = $_POST['materia'];
        $profesor = $_POST['profesor'];


        $sql_datos = "UPDATE web SET materia = :materia, profesor = :profesor WHERE ID = :ID";
        $stmt_ob = $pdo->prepare($sql_datos);
        $stmt_ob->bindParam(':ID', $id);
        $stmt_ob->bindParam(':materia', $materia);
        $stmt_ob->bindParam(':profesor', $profesor);
        if ($stmt_ob->execute()) {
           
            header("Location: ../index.php?message=Registro actualizado");
            exit;
        } else {
            echo "Error al actualizar el registro.";
        }
    } else {
        echo "Por favor complete todos los campos.";
    }
} elseif (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $sql_select = "SELECT * FROM web WHERE ID = :ID";
    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->bindParam(':ID', $id);
    $stmt_select->execute();
    $materia = $stmt_select->fetch(PDO::FETCH_ASSOC);
    var_dump($materia);
    if ($materia === false) {
        die("No se encontró la materia con el ID especificado.");
    }
} else {
    die("No se ha especificado un ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia</title>
</head>
<body>
    <h1>Editar Materia</h1>
    <?php if (is_array($materia)): ?>
    <form action="editar.php" method="post">
        <input type="hidden" name="ID" value="<?php echo htmlspecialchars($materia['ID']); ?>">
        <label for="materia">Nombre de la materia:</label>
        <input type="text" id="materia" name="materia" value="<?php echo htmlspecialchars($materia['materia']); ?>" required><br><br>

        <label for="profesor">Nombre del profesor:</label>
        <input type="text" id="profesor" name="profesor" value="<?php echo htmlspecialchars($materia['profesor']); ?>" required><br><br>

        <input type="submit" value="Actualizar Materia">
    </form>
    <a href="index.php">Volver a la lista</a>
    <?php else: ?>
    <p>No se ha encontrado la materia para editar.</p>
    <?php endif; ?>
    
</body>
</html>
