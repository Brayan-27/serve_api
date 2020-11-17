<?php

require_once("cors.php");
require_once("conexion.php");

    $fila = array();
    $modelo = new conexion();
    $conexion = $modelo-> getConexion();
    $sql = "SELECT * FROM dato_diarioL";
    $cosulta = $conexion->prepare($sql);
    $cosulta-> execute();
    while($resultado = $cosulta-> fetch()){
        $fila[] = array(
            'id_DL' =>$resultado['id_DL'],
            'semana' =>$resultado['semana'],
            'total_costo' =>$resultado['total_costo'],
        );
    }
$jsonstring = json_encode($fila);
echo $jsonstring;

?>