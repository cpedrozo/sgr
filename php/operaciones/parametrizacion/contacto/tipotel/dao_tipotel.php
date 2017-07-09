<?php

class dao_tipotel
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT * FROM sgr.tipotel";
  	$datos = consultar_fuente($sql);
    return $datos;
  }
  */

    static function get_datos($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

      $sql = "SELECT * FROM sgr.tipotel
              $where_armado";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
