<?php

class dao_sector
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT * FROM sgr.sucursal";
  	$datos = consultar_fuente($sql);
    return $datos;
  }
  */
  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT s.id_sector, s.nombre, d.nombre dpto
            FROM sgr.sector s
            LEFT JOIN sgr.dpto d ON s.id_dpto = d.id_dpto
            $where_armado ORDER BY d.nombre, s.nombre ASC
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

    $sql = "SELECT s.id_sector, s.nombre, d.nombre dpto
            FROM sgr.sector s
            LEFT JOIN sgr.dpto d ON s.id_dpto = d.id_dpto
            $where_armado ORDER BY d.nombre, s.nombre ASC";

    $resultado = consultar_fuente($sql);
    return $resultado;
  }
}
?>
