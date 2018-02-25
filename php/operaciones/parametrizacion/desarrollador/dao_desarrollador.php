<?php

class dao_desarrollador
{
    static function get_datossinfiltro($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

    	$sql = "SELECT *
              FROM sgr.sgr
              WHERE activo = 'true'
              limit 10";
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
              FROM sgr.sgr
              $where_armado";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

}
?>
