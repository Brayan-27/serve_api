<?php

require_once("cors.php");
require_once("conexion.php");


$data = json_decode(file_get_contents("php://input"),true);
    $semana = $data ['semana'];
    $total_costo = $data ['total_costo'];
   

        $modelo = new conexion();
        $conexion = $modelo->getConexion();
        $sql = "INSERT INTO dato_diarioa(semana, total_costo) VALUES(:semana, :total_costo)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':semana', $semana);
            $consulta->bindParam(':total_costo', $total_costo);
            $consulta->execute();
        
        $string = '{"msg": "registro exitosoeje"}';
        echo $string;
?>


