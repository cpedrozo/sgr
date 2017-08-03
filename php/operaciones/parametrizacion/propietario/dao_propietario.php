<?php

class dao_propietario
{
    static function get_datossinfiltro($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

    	$sql = "SELECT *
              FROM sgr.propietario
              WHERE activo = 'true'
              LIMIT 5";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }
    static function get_datos($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }
    	$sql = "SELECT *
              FROM sgr.propietario
              $where_armado";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

}
?>
