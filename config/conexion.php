<?php

class Conexion {

    public function __construct()
    {
        $base = parse_ini_file("../config/config.ini");
        $conexion = new mysqli($base['servername'], $base['username'], $base['password'], $base['dbname']);

        if ($conexion->errno) {
            echo "Error";
        } else {
            echo "OK";
        }
        return $conexion;
    }
}

