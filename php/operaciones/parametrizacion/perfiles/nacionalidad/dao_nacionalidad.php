<?php

class dao_nacionalidad
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT * FROM sgr.nacionalidad";
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

      $sql = "SELECT *
              FROM sgr.nacionalidad
              $where_armado";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
