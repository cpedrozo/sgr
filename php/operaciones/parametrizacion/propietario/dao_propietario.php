<?php

class dao_propietario
{
  static function get_datos()
  {
    //$verif = "true"
  	$sql = "SELECT *
            FROM sgr.propietario
            WHERE activo = true";
  	$datos = consultar_fuente($sql);
    return $datos;
  }
}
?>
