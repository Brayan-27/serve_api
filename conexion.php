<?php

class Conexion{

    public function getConexion(){
        $usuario="bryan12";
        $Password="Bryan-123";
        $localhost="localhost";
        $db="proyecto27_db";

        $conexion=new PDO("mysql:host=$localhost; dbname=$db;", $usuario, $Password);
        return $conexion;
    }
}

?>