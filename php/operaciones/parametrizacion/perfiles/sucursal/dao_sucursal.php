<?php

class dao_sucursal
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

      $sql = "SELECT s.id_sucursal, s.nombre,
              c.nombre||' - '||p.nombre localidad
              FROM sgr.sucursal s
              LEFT JOIN sgr.ciudad c ON s.id_ciudad = c.id_ciudad
              LEFT JOIN sgr.provincia p ON c.id_provincia = p.id_provincia
              $where_armado
              ORDER BY p.nombre, c.nombre";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
