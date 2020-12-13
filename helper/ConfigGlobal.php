<?php

class ConfigGlobal {

	public function ObtenerConfig() {
            require_once("config.php");
			$entorno =  array(
				    "db" => array(
					"nombre"    	=> DB_NAME,
					"usuario"   	=> DB_USER,
					"password"  	=> DB_PASSWORD,
					"host"			=> DB_HOST
				)
			);
		return $entorno;
	}

	public function normalizarTexto($input) {
		if(!empty($input)) {
			$texto = ucwords(strtolower($input));
			return $texto;
		}
	}	

    public function prepare($sql)
    {
 
        return $this->dbo->prepare($sql);
 
    }
 
    public static function singleton_conexion()
    {
 
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
 
        }
 
        return self::$instancia;
        
    }
 
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    {
 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
 
    }
}