<?php

require_once("cors.php");
require_once("conexion.php");

    $fila = array();
    $modelo = new conexion();
    $conexion = $modelo-> getConexion();
    $sql = "SELECT * FROM Pedidos_Semanal_Valle";
    $cosulta = $conexion->prepare($sql);
    $cosulta-> execute();
    while($resultado = $cosulta-> fetch()){
        $fila[] = array(
            'id_PSV' =>$resultado['id_PSV'],
            'Des_de_semana' =>$resultado['Des_de_semana'],
            'mes' =>$resultado['mes'],
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