<?php

require_once("cors.php");
require_once("conexion.php");

    $fila = array();
    $modelo = new conexion();
    $conexion = $modelo-> getConexion();
    $sql = "SELECT * FROM tb_semanala";
    $cosulta = $conexion->prepare($sql);
    $cosulta-> execute();
    while($resultado = $cosulta-> fetch()){
        $fila[] = array(
            'id_a' =>$resultado['id_a'],
            'numsemana' =>$resultado['numsemana'],
            'descripcion' =>$resultado['descripcion'],
            'lunes' =>$resultado['lunes'],
            'martes' =>$resultado['martes'],
            'miercoles' =>$resultado['miercoles'],
            'jueves' =>$resultado['jueves'],
            'viernes' =>$resultado['viernes'],
            'sabado' =>$resultado['sabado'],
            'domingo' =>$resultado['domingo'], 
        );
    }
$jsonstring = json_encode($fila);
echo $jsonstring;

?>