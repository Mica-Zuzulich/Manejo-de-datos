<?php
//conexiion!!

$host='localhost';
$user='root';
$password='';
$dbname='sistema';


try{
    $pdo= new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
    //manejamoss los errores en pdo
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Error de conexión: " . $e->getMessage());


}
?>