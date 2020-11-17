<?php

require_once("cors.php");
require_once("conexion.php");

    $fila = array();
    $modelo = new conexion();
    $conexion = $modelo-> getConexion();
    $sql = "SELECT * FROM productol";
    $cosulta = $conexion->prepare($sql);
    $cosulta-> execute();
    while($resultado = $cosulta-> fetch()){
        $fila[] = array(
            'id_PL' =>$resultado['id_PL'],
            'tipo' =>$resultado['tipo'],
            'nombreali' =>$resultado['nombreali'],
            'cantidad_pro' =>$resultado['cantidad_pro'],
            'cantidad_min' =>$resultado['cantidad_min'],
            'cantidad_med' =>$resultado['cantidad_med'],
            'cantidad_max' =>$resultado['cantidad_max'],
        );
    }
$jsonstring = json_encode($fila);
echo $jsonstring;

?>