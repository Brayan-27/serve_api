<?php

require_once("cors.php");
require_once("conexion.php");


$data = json_decode(file_get_contents("php://input"),true);
    $tipo = $data ['tipo'];
    $nombreali = $data ['nombreali'];
    $cantidad_pro = $data ['cantidad_pro'];
    $cantidad_min = $data ['cantidad_min'];
    $cantidad_med = $data ['cantidad_med'];
    $cantidad_max = $data ['cantidad_max'];
 
        $modelo = new conexion();
        $conexion = $modelo->getConexion();
        $sql = "INSERT INTO productoa(tipo, nombreali, cantidad_pro, cantidad_min, cantidad_med, cantidad_max) VALUES(:tipo, :nombreali, :cantidad_pro, :cantidad_min, :cantidad_med, :cantidad_max)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':tipo', $tipo);
            $consulta->bindParam(':nombreali', $nombreali);
            $consulta->bindParam(':cantidad_pro', $cantidad_pro);
            $consulta->bindParam(':cantidad_min', $cantidad_min);
            $consulta->bindParam(':cantidad_med', $cantidad_med);
            $consulta->bindParam(':cantidad_max', $cantidad_max);
            $consulta->execute();
        
        $string = '{"msg": "registro exitosoeje"}';
        echo $string;
?>