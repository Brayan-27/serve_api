<?php

require_once("cors.php");
require_once("conexion.php");

    $fila = array();
    $modelo = new conexion();
    $conexion = $modelo-> getConexion();
    $sql = "SELECT * FROM pedidos_diario_llano";
    $cosulta = $conexion->prepare($sql);
    $cosulta-> execute();
    while($resultado = $cosulta-> fetch()){
        $fila[] = array(
            'id_PDL' =>$resultado['id_PDL'],
            'Des_de_alimnentos' =>$resultado['Des_de_alimnentos'],
            'Unidad_de_Media' =>$resultado['Unidad_de_Media'],
            'Gr_ML_Desayuno' =>$resultado['Gr_ML_Desayuno'],
            'Gr_ML_Sopa' =>$resultado['Gr_ML_Sopa'],
            'Gr_ML_Segundo' =>$resultado['Gr_ML_Segundo'],
            'Gr_ML_Cena' =>$resultado['Gr_ML_Cena'],
        );
    }
$jsonstring = json_encode($fila);
echo $jsonstring;

?>

