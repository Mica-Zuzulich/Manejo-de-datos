<?php
require 'db.php';//lo conectamos con la base de datos !

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_POST['materia']) && !empty($_POST['profesor']) && !empty($_POST['carrera_id'])){
        $materia=$_POST['materia'];
        $profesor=$_POST['profesor'];
        $carrera_id=$_POST['carrera_id'];



        $sql_insert = "INSERT INTO web (materia, profesor, carrera_id) VALUES (:materia, :profesor, :carrera_id)";
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->bindValue(':materia', $materia, PDO::PARAM_STR);
        $stmt_insert->bindValue(':profesor', $profesor, PDO::PARAM_STR);
        $stmt_insert->bindValue(':carrera_id', $carrera_id, PDO::PARAM_INT);
       
       if ($stmt_insert->execute()) {
        header("Location: ../index.php?message=Registro+exitoso");
        exit(); 
    } else {
        echo "Error al registrar los datos.";
    }
} else {
    echo "Por favor complete todos los campos.";
}
}
?>