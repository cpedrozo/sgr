<?php

class dao_companias_telefonicas
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT * FROM sgr.compania";
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

      $sql = "SELECT * FROM sgr.compania
              $where_armado";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }

}
?>
