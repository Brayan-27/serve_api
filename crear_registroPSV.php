<?php

require_once("cors.php");
require_once("conexion.php");


$data = json_decode(file_get_contents("php://input"),true);
    $Des_de_semana = $data ['Des_de_semana'];
    $mes = $data ['mes'];
    $lunes = $data ['lunes'];
    $martes = $data ['martes'];
    $miercoles = $data ['miercoles'];
    $jueves = $data ['jueves'];
    $viernes = $data ['viernes'];
    $sabado = $data ['sabado'];
    $domingo = $data ['domingo'];
  
 

        $modelo = new conexion();
        $conexion = $modelo->getConexion();
        $sql = "INSERT INTO Pedidos_Semanal_Valle(Des_de_semana, mes, lunes, martes, miercoles, jueves, viernes, sabado, domingo) VALUES(:Des_de_semana, :mes, :lunes, :martes, :miercoles, :jueves, :viernes, :sabado, :domingo)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':Des_de_semana', $Des_de_semana);
            $consulta->bindParam(':mes', $mes);
            $consulta->bindParam(':lunes', $lunes);
            $consulta->bindParam(':martes', $martes);
            $consulta->bindParam(':miercoles', $miercoles);
            $consulta->bindParam(':jueves', $jueves);
            $consulta->bindParam(':viernes', $viernes);
            $consulta->bindParam(':sabado', $sabado);
            $consulta->bindParam(':domingo', $domingo);
            $consulta->execute();
        
        $string = '{"msg": "registro exitoso de la semanal"}';
        echo $string;
?>