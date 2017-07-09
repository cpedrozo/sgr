<?php

class dao_departamento
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT * FROM sgr.sucursal";
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

      $sql = "SELECT d.id_dpto, d.nombre, s.nombre sucursal
              FROM sgr.dpto d
              LEFT JOIN sgr.sucursal s ON d.id_sucursal = s.id_sucursal
              $where_armado ORDER BY s.nombre, d.nombre ASC";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
