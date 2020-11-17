<?php

require_once("cors.php");
require_once("conexion.php");


$data = json_decode(file_get_contents("php://input"),true);
    $Des_de_alimnentos = $data ['Des_de_alimnentos'];
    $Unidad_de_Media = $data ['Unidad_de_Media'];
    $Gr_ML_Desayuno = $data ['Gr_ML_Desayuno'];
    $Gr_ML_Sopa = $data ['Gr_ML_Sopa'];
    $Gr_ML_Segundo = $data ['Gr_ML_Segundo'];
    $Gr_ML_Cena = $data ['Gr_ML_Cena'];
  
 

        $modelo = new conexion();
        $conexion = $modelo->getConexion();
        $sql = "INSERT INTO pedidos_diario_valle(Des_de_alimnentos, Unidad_de_Media, Gr_ML_Desayuno, Gr_ML_Sopa, Gr_ML_Segundo, Gr_ML_Cena) VALUES(:Des_de_alimnentos, :Unidad_de_Media, :Gr_ML_Desayuno, :Gr_ML_Sopa, :Gr_ML_Segundo, :Gr_ML_Cena)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':Des_de_alimnentos', $Des_de_alimnentos);
            $consulta->bindParam(':Unidad_de_Media', $Unidad_de_Media);
            $consulta->bindParam(':Gr_ML_Desayuno', $Gr_ML_Desayuno);
            $consulta->bindParam(':Gr_ML_Sopa', $Gr_ML_Sopa);
            $consulta->bindParam(':Gr_ML_Segundo', $Gr_ML_Segundo);
            $consulta->bindParam(':Gr_ML_Cena', $Gr_ML_Cena);
            $consulta->execute();
        
        $string = '{"msg": "registro exitosoeje"}';
        echo $string;
?>