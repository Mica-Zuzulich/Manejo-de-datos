<?php
require 'db.php';

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];

    $sql_delete = "DELETE FROM web WHERE ID = :ID";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':ID', $id);
    $stmt_delete->execute();

    header('Location: ../index.php'); // Redirige a la página principal después de la eliminación
    exit();
} else {
    echo "No se ha especificado un ID.";
}