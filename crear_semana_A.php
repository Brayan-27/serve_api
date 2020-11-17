<?php

require_once("cors.php");
require_once("conexion.php");


$data = json_decode(file_get_contents("php://input"),true);
    $numsemana = $data ['numsemana'];
    $descripcion = $data ['descripcion'];
    $lunes = $data ['lunes'];
    $martes = $data ['martes'];
    $miercoles = $data ['miercoles'];
    $jueves = $data ['jueves'];
    $viernes = $data ['viernes'];
    $sabado = $data ['sabado'];
    $domingo = $data ['domingo'];

        $modelo = new conexion();
        $conexion = $modelo->getConexion();
        $sql = "INSERT INTO tb_semanalA(numsemana, descripcion, lunes, martes, miercoles, jueves, viernes, sabado, domingo) VALUES(:numsemana, :descripcion, :lunes, :martes, :miercoles, :jueves, :viernes, :sabado, :domingo)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':numsemana', $numsemana);
            $consulta->bindParam(':descripcion', $descripcion);
            $consulta->bindParam(':lunes', $lunes);
            $consulta->bindParam(':martes', $martes);
            $consulta->bindParam(':miercoles', $miercoles);
            $consulta->bindParam(':jueves', $jueves);
            $consulta->bindParam(':viernes', $viernes);
            $consulta->bindParam(':sabado', $sabado);
            $consulta->bindParam(':domingo', $domingo);
            $consulta->execute();
        
        $string = '{"msg": "registro exitoso"}';
        echo $string;
?>